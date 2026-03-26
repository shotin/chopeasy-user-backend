<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreateWeightTierRequest;
use App\Models\WeightTier;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class WeightTierController extends Controller
{
    /**
     * Get all weight tiers
     */
    public function index(Request $request): JsonResponse
    {
        $query = WeightTier::query();

        if ($request->has('region_id')) {
            $query->forRegion($request->region_id);
        }

        if ($request->has('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        $tiers = $query->orderedByWeight()->paginate(50);

        return response()->json([
            'success' => true,
            'data' => $tiers,
        ]);
    }

    /**
     * Create a new weight tier (price per kg rate)
     */
    public function store(CreateWeightTierRequest $request): JsonResponse
    {
        try {
            $data = $request->validated();
            $data['min_weight'] = $data['min_weight'] ?? 0;
            $data['max_weight'] = $data['max_weight'] ?? 9999;
            $data['multiplier'] = $data['multiplier'] ?? 1;
            $data['base_service_fee'] = $data['base_service_fee'] ?? 0;

            $tier = WeightTier::create($data);

            return response()->json([
                'success' => true,
                'message' => 'Weight tier created successfully',
                'data' => $tier,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create weight tier',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get a specific weight tier
     */
    public function show(WeightTier $weightTier): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $weightTier,
        ]);
    }

    /**
     * Update a weight tier
     */
    public function update(CreateWeightTierRequest $request, WeightTier $weightTier): JsonResponse
    {
        try {
            $data = $request->validated();
            if (!isset($data['min_weight'])) $data['min_weight'] = $weightTier->min_weight ?? 0;
            if (!isset($data['max_weight'])) $data['max_weight'] = $weightTier->max_weight ?? 9999;

            $weightTier->update($data);

            return response()->json([
                'success' => true,
                'message' => 'Weight tier updated successfully',
                'data' => $weightTier->fresh(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update weight tier',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Toggle active status
     */
    public function toggleActive(WeightTier $weightTier): JsonResponse
    {
        try {
            $weightTier->update(['is_active' => !$weightTier->is_active]);
            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'data' => $weightTier->fresh(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a weight tier
     */
    public function destroy(WeightTier $weightTier): JsonResponse
    {
        try {
            if ($weightTier->orders()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete weight tier with associated orders. Consider deactivating instead.',
                ], 422);
            }

            $weightTier->delete();

            return response()->json([
                'success' => true,
                'message' => 'Weight tier deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete weight tier',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Bulk create weight tiers
     */
    public function bulkStore(Request $request): JsonResponse
    {
        $request->validate([
            'tiers' => 'required|array|min:1',
            'tiers.*.min_weight' => 'required|numeric|min:0',
            'tiers.*.max_weight' => 'required|numeric',
            'tiers.*.multiplier' => 'required|integer|min:1',
            'tiers.*.base_service_fee' => 'required|numeric|min:0',
            'region_id' => 'required|string',
        ]);

        try {
            $created = [];
            
            foreach ($request->tiers as $tierData) {
                $tierData['region_id'] = $request->region_id;
                $tierData['is_active'] = true;
                
                $created[] = WeightTier::create($tierData);
            }

            return response()->json([
                'success' => true,
                'message' => count($created) . ' weight tiers created successfully',
                'data' => $created,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create weight tiers',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
