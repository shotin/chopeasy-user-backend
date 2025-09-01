<?php

namespace App\Http\Controllers\v1\Users;

use App\Http\Controllers\Controller;
use App\Services\ProductReviewed\RecentlyViewedService;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\Cookie as SymfonyCookie;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class RecentlyViewedController extends Controller
{
    protected $service;

    public function __construct(RecentlyViewedService $service)
    {
        $this->service = $service;
    }

    // protected function getSessionId(Request $request): string
    // {
    //     return $request->cookie('cart_session_id') ?? Str::uuid()->toString();
    // }
    protected function getSessionId(Request $request, &$cookie = null): ?string
    {
        $existing = $request->cookie('cart_session_id');

        if ($existing) {
            return $existing;
        }

        $sessionId = Str::uuid()->toString();
        $secure = app()->environment('production') || (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on');
        $sameSite = $secure ? 'None' : 'Lax';

        $cookie = new SymfonyCookie(
            'cart_session_id',
            $sessionId,
            now()->addYear(),
            '/',
            null,
            $secure,
            false,
            false,
            $sameSite
        );

        return $sessionId;
    }
    
    public function addViewedProduct(Request $request)
    {
        Auth::shouldUse('api');
        $request->validate([
            'product_id' => 'required|integer',
        ]);

        $productId = $request->product_id;

        $productExists = $this->service->checkProductExists($productId);
        if (!$productExists) {
            return response()->json(['error' => 'Product not found'], 404);
        }
        $userId = Auth::id();
        $sessionId = $userId ? null : $this->getSessionId($request);

        $this->service->addProductView($userId, $sessionId, $productId);

        return response()->json(['message' => 'Product marked as viewed']);
    }

    public function getViewedProducts(Request $request)
    {
        Auth::shouldUse('api');
        $userId = Auth::id();
        $sessionId = $userId ? null : $this->getSessionId($request);

        $allProductIds = $this->service->getViewedProductIds($userId, $sessionId);

        if (empty($allProductIds)) {
            return response()->json([
                'recently_viewed' => [],
                'pagination' => [
                    'currentPage' => 1,
                    'lastPage' => 1,
                    'perPage' => 10,
                    'total' => 0,
                ],
            ]);
        }

        $page = $request->query('page', 1);
        $perPage = 10;
        $offset = ($page - 1) * $perPage;

        $productIdsPage = array_slice($allProductIds, $offset, $perPage);

        $products = $this->service->fetchProductsFromInventory($productIdsPage);

        $paginator = new LengthAwarePaginator(
            $products,
            count($allProductIds),
            $perPage,
            $page,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return response()->json([
            'recently_viewed' => $products,
            'pagination' => [
                'currentPage' => $paginator->currentPage(),
                'lastPage' => $paginator->lastPage(),
                'perPage' => $paginator->perPage(),
                'total' => $paginator->total(),
            ],
        ]);
    }
}
