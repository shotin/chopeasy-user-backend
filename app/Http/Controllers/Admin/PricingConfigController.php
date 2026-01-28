<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CreatePricingConfigRequest;
use App\Http\Requests\Admin\PricingPreviewRequest;
use App\Models\PricingConfig;
use App\Services\PricingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class PricingConfigController extends Controller
{
    /**
     * Get all pricing configurations
     */
    public function index(Request $request): JsonResponse
    {
        $query = PricingConfig::query()->with(['orders' => function ($q) {
            $q->latest()->limit(5);
        }]);

        if ($request->has('region_id')) {
            $query->forRegion($request->region_id);
        }

        if ($request->has('is_active')) {
            $query->where('is_active', $request->boolean('is_active'));
        }

        $configs = $query->latest()->paginate(20);

        return response()->json([
            'success' => true,
            'data' => $configs,
        ]);
    }

    /**
     * Create a new pricing configuration
     */
    public function store(CreatePricingConfigRequest $request): JsonResponse
    {
        try {
            // If setting as active, deactivate others in the same region
            if ($request->boolean('is_active', true)) {
                PricingConfig::where('region_id', $request->region_id)
                    ->where('is_active', true)
                    ->update(['is_active' => false]);
            }

            $config = PricingConfig::create($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Pricing configuration created successfully',
                'data' => $config,
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to create pricing configuration',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Get a specific pricing configuration
     */
    public function show(PricingConfig $pricingConfig): JsonResponse
    {
        $pricingConfig->load(['orders' => function ($q) {
            $q->latest()->limit(10);
        }]);

        return response()->json([
            'success' => true,
            'data' => $pricingConfig,
        ]);
    }

    /**
     * Update a pricing configuration
     */
    public function update(CreatePricingConfigRequest $request, PricingConfig $pricingConfig): JsonResponse
    {
        try {
            // If setting as active, deactivate others in the same region
            if ($request->boolean('is_active') && !$pricingConfig->is_active) {
                PricingConfig::where('region_id', $request->region_id)
                    ->where('id', '!=', $pricingConfig->id)
                    ->where('is_active', true)
                    ->update(['is_active' => false]);
            }

            $pricingConfig->update($request->validated());

            return response()->json([
                'success' => true,
                'message' => 'Pricing configuration updated successfully',
                'data' => $pricingConfig->fresh(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to update pricing configuration',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Delete a pricing configuration
     */
    public function destroy(PricingConfig $pricingConfig): JsonResponse
    {
        try {
            if ($pricingConfig->orders()->exists()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cannot delete pricing config with associated orders. Consider deactivating instead.',
                ], 422);
            }

            $pricingConfig->delete();

            return response()->json([
                'success' => true,
                'message' => 'Pricing configuration deleted successfully',
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete pricing configuration',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Preview pricing with different scenarios
     */
    public function preview(PricingPreviewRequest $request): JsonResponse
    {
        try {
            $regionId = $request->input('region_id', 'NG-DEFAULT');
            $pricingService = new PricingService($regionId);

            $results = $pricingService->previewPricing($request->input('scenarios'));

            return response()->json([
                'success' => true,
                'data' => [
                    'region_id' => $regionId,
                    'results' => $results,
                ],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to preview pricing',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Validate pricing configuration for a region
     */
    public function validate(Request $request): JsonResponse
    {
        $regionId = $request->input('region_id', 'NG-DEFAULT');
        $pricingService = new PricingService($regionId);

        $validation = $pricingService->validateConfiguration($regionId);

        return response()->json([
            'success' => true,
            'data' => $validation,
        ]);
    }

    /**
     * Toggle active status
     */
    public function toggleActive(PricingConfig $pricingConfig): JsonResponse
    {
        try {
            $newStatus = !$pricingConfig->is_active;

            // If activating, deactivate others in the same region
            if ($newStatus) {
                PricingConfig::where('region_id', $pricingConfig->region_id)
                    ->where('id', '!=', $pricingConfig->id)
                    ->where('is_active', true)
                    ->update(['is_active' => false]);
            }

            $pricingConfig->update(['is_active' => $newStatus]);

            return response()->json([
                'success' => true,
                'message' => 'Status updated successfully',
                'data' => $pricingConfig->fresh(),
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to toggle status',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
