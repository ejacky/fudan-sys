<?php

namespace App\Presenters;

use App\Models\Supplier;
use App\Models\Product;
use App\Models\Buyer;
use App\Models\Wms;

class FudanPresenter extends CommonPresenter
{
    public function getProductHandle()
    {
        return [
            [
                'icon'  => 'plus',
                'class' => 'success',
                'title' => '新增',
                'route' => 'backend.product.create',
            ],
        ];
    }

    public function getProcurementHandle()
    {
        return [
            [
                'icon'  => 'plus',
                'class' => 'success',
                'title' => '新增',
                'route' => 'backend.procurement.create',
            ],
        ];
    }

    public function getSupplierHandle()
    {
        return [
            [
                'icon'  => 'plus',
                'class' => 'success',
                'title' => '新增',
                'route' => 'backend.supplier.create',
            ],
        ];
    }

    public function getBuyerHandle()
    {
        return [
            [
                'icon'  => 'plus',
                'class' => 'success',
                'title' => '新增',
                'route' => 'backend.buyer.create',
            ],
        ];
    }

    public function getWmsHandle()
    {
        return [
            [
                'icon'  => 'plus',
                'class' => 'success',
                'title' => '新增',
                'route' => 'backend.wms.create',
            ],
        ];
    }

    public function getSupplierById($supplierId)
    {
        if (empty($supplierId)) {
            return '无';
        }
        try {
            $supplier = Supplier::find($supplierId);
            return $supplier->name;
        } catch (\Exception $e) {
            return '错误';
        }
    }

    public function getProductById($productId)
    {
        if (empty($productId)) {
            return '无';
        }
        try {
            $product = Product::find($productId);
            return $product->name;
        } catch (\Exception $e) {
            return '错误';
        }
    }

    public function getBuyerById($buyerId)
    {
        if (empty($buyerId)) {
            return '无';
        }
        try {
            $buyerId = Buyer::find($buyerId);
            return $buyerId->name;
        } catch (\Exception $e) {
            return '错误';
        }
    }

    public function getWmsById($wmsId)
    {
        if (empty($wmsId)) {
            return '无';
        }
        try {
            $wms = Wms::find($wmsId);
            return $wms->name;
        } catch (\Exception $e) {
            return '错误';
        }
    }
}