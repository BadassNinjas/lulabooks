<?php

return [
  'models' => [
    \ShopKit\Product\Models\Product::class,
    \ShopKit\Product\Models\ProductImage::class,
    \ShopKit\Product\Models\ProductCategory::class,
    \ShopKit\ACL\Models\User::class,
    \ShopKit\ACL\Models\UserBillingDetail::class,
    \App\Models\SalesRequest::class,
    \App\Models\ContactMessage::class,
    \App\Models\Transaction::class,
  ],
];
