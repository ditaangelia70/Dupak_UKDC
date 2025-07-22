<?php
namespace App\Services;

use App\Models\Alternative;
use App\Models\Criteria;

class AHPService
{
    /**
     * Perform AHP calculation
     * 
     * @return array
     */
    public function calculate()
    {
        $criteria = Criteria::all();
        $alternatives = Alternative::with('criteriaValues.criteria')->get();
        
        // Step 1: Normalize criteria weights
        $totalWeight = $criteria->sum('weight');
        $normalizedWeights = [];
        
        foreach ($criteria as $criterion) {
            $normalizedWeights[$criterion->id] = $criterion->weight / $totalWeight;
        }
        
        // Step 2: Calculate decision matrix
        $decisionMatrix = [];
        
        foreach ($alternatives as $alternative) {
            $values = [];
            
            foreach ($criteria as $criterion) {
                $criteriaValue = $alternative->criteriaValues
                    ->where('criteria_id', $criterion->id)
                    ->first();
                
                $values[$criterion->id] = $criteriaValue ? $criteriaValue->value : 0;
            }
            
            $decisionMatrix[$alternative->id] = $values;
        }
        
        // Step 3: Normalize decision matrix
        $normalizedMatrix = $this->normalizeDecisionMatrix($decisionMatrix);
        
        // Step 4: Calculate weighted normalized decision matrix
        $weightedMatrix = $this->calculateWeightedMatrix($normalizedMatrix, $normalizedWeights);
        
        // Step 5: Calculate final scores and ranking
        $results = [];
        
        foreach ($alternatives as $alternative) {
            $score = 0;
            $criteriaDetails = [];
            
            foreach ($criteria as $criterion) {
                $criteriaId = $criterion->id;
                $criteriaValue = $alternative->criteriaValues
                    ->where('criteria_id', $criteriaId)
                    ->first();
                
                $value = $criteriaValue ? $criteriaValue->value : 0;
                $weight = $normalizedWeights[$criteriaId];
                $weightedValue = $weightedMatrix[$alternative->id][$criteriaId] ?? 0;
                
                $score += $weightedValue;
                
                $criteriaDetails[] = [
                    'criteria_id' => $criteriaId,
                    'criteria_name' => $criterion->name,
                    'value' => $value,
                    'weight' => $weight,
                    'weighted_value' => $weightedValue,
                    'is_below_minimum' => ($criterion->min_value !== null && $value < $criterion->min_value)
                ];
            }
            
            $results[] = [
                'alternative_id' => $alternative->id,
                'alternative_name' => $alternative->name,
                'score' => $score,
                'is_passed' => $alternative->is_passed,
                'criteria_details' => $criteriaDetails
            ];
        }
        
        // Sort results by score in descending order
        usort($results, function ($a, $b) {
            return $b['score'] <=> $a['score'];
        });
        
        // Add ranking
        foreach ($results as $key => $result) {
            $results[$key]['rank'] = $key + 1;
        }
        
        return [
            'normalized_weights' => $normalizedWeights,
            'results' => $results
        ];
    }
    
    /**
     * Normalize decision matrix
     * 
     * @param array $matrix
     * @return array
     */
    private function normalizeDecisionMatrix(array $matrix)
    {
        $normalizedMatrix = [];
        $columnSums = [];
        
        // Calculate column sums
        foreach ($matrix as $alternativeId => $criteriaValues) {
            foreach ($criteriaValues as $criteriaId => $value) {
                if (!isset($columnSums[$criteriaId])) {
                    $columnSums[$criteriaId] = 0;
                }
                $columnSums[$criteriaId] += pow($value, 2);
            }
        }
        
        // Normalize values
        foreach ($matrix as $alternativeId => $criteriaValues) {
            $normalizedMatrix[$alternativeId] = [];
            
            foreach ($criteriaValues as $criteriaId => $value) {
                $normalizedMatrix[$alternativeId][$criteriaId] = 
                    $columnSums[$criteriaId] > 0 ? 
                    $value / sqrt($columnSums[$criteriaId]) : 0;
            }
        }
        
        return $normalizedMatrix;
    }
    
    /**
     * Calculate weighted normalized matrix
     * 
     * @param array $normalizedMatrix
     * @param array $weights
     * @return array
     */
    private function calculateWeightedMatrix(array $normalizedMatrix, array $weights)
    {
        $weightedMatrix = [];
        
        foreach ($normalizedMatrix as $alternativeId => $criteriaValues) {
            $weightedMatrix[$alternativeId] = [];
            
            foreach ($criteriaValues as $criteriaId => $value) {
                $weightedMatrix[$alternativeId][$criteriaId] = $value * $weights[$criteriaId];
            }
        }
        
        return $weightedMatrix;
    }
}