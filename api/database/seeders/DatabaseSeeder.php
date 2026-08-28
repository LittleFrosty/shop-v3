<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();
        $password = Hash::make('password');

        $adminId = DB::table('admin_users')->insertGetId([
            'name' => 'Shop Admin',
            'email' => 'admin@shop-v2.test',
            'email_verified_at' => $now,
            'password' => $password,
            'status' => 1,
            'locked_reason' => null,
            'locked' => false,
            'main_account' => 1,
            'token' => Str::random(40),
            'ip_address' => '127.0.0.1',
            'remember_token' => Str::random(10),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $userId = DB::table('users')->insertGetId([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'company' => 'Acme Ltd',
            'phone' => '+359888000111',
            'email_verified_at' => $now,
            'password' => $password,
            'country' => 'Bulgaria',
            'city' => 'Sofia',
            'address' => 'Vitosha Blvd 1',
            'status' => 1,
            'wholesale' => 0,
            'wholesale_profile' => 0,
            'total_sum' => 189.90,
            'remember_token' => Str::random(10),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $guestUserId = DB::table('users')->insertGetId([
            'name' => 'Maria Petrova',
            'email' => 'maria@example.com',
            'company' => null,
            'phone' => '+359888000222',
            'email_verified_at' => $now,
            'password' => $password,
            'country' => 'Bulgaria',
            'city' => 'Plovdiv',
            'address' => 'Main Street 12',
            'status' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $colorAttrId = DB::table('attribute')->insertGetId([
            'title' => 'Color',
            'in_filter' => 1,
            'sort_order' => 1,
            'type' => 'color',
        ]);
        $sizeAttrId = DB::table('attribute')->insertGetId([
            'title' => 'Material',
            'in_filter' => 1,
            'sort_order' => 2,
            'type' => 'button',
        ]);

        $blackValueId = DB::table('attribute_values')->insertGetId([
            'attribute_id' => $colorAttrId,
            'sort_order' => 1,
            'color' => '#000000',
            'value' => 'Black',
        ]);
        $whiteValueId = DB::table('attribute_values')->insertGetId([
            'attribute_id' => $colorAttrId,
            'sort_order' => 2,
            'color' => '#ffffff',
            'value' => 'White',
        ]);
        $cottonValueId = DB::table('attribute_values')->insertGetId([
            'attribute_id' => $sizeAttrId,
            'sort_order' => 1,
            'color' => '#000000',
            'value' => 'Cotton',
        ]);

        $brandNike = DB::table('brand')->insertGetId([
            'title' => 'Nordic Home',
            'sort_order' => 1,
            'image' => '/images/brands/nordic.png',
            'status' => 1,
        ]);
        $brandAcme = DB::table('brand')->insertGetId([
            'title' => 'Acme Tools',
            'sort_order' => 2,
            'image' => '/images/brands/acme.png',
            'status' => 1,
        ]);

        $sizeOptionId = DB::table('options')->insertGetId([
            'title' => 'Size',
            'visible_in_filter' => 1,
            'type' => 'select',
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $sizeS = DB::table('option_values')->insertGetId([
            'value' => 'S',
            'option_id' => $sizeOptionId,
            'additional_value' => null,
            'sort_order' => 1,
        ]);
        $sizeM = DB::table('option_values')->insertGetId([
            'value' => 'M',
            'option_id' => $sizeOptionId,
            'additional_value' => null,
            'sort_order' => 2,
        ]);
        $sizeL = DB::table('option_values')->insertGetId([
            'value' => 'L',
            'option_id' => $sizeOptionId,
            'additional_value' => null,
            'sort_order' => 3,
        ]);

        $catFurniture = DB::table('category')->insertGetId([
            'top' => true,
            'status' => 1,
            'image' => '/images/categories/furniture.jpg',
            'parent_id' => null,
            'depth' => 0,
            'sort_order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $catTools = DB::table('category')->insertGetId([
            'top' => true,
            'status' => 1,
            'image' => '/images/categories/tools.jpg',
            'parent_id' => null,
            'depth' => 0,
            'sort_order' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
        $catChairs = DB::table('category')->insertGetId([
            'top' => false,
            'status' => 1,
            'image' => '/images/categories/chairs.jpg',
            'parent_id' => $catFurniture,
            'depth' => 1,
            'sort_order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('category_description')->insert([
            [
                'title' => 'Furniture',
                'description' => 'Home and office furniture.',
                'category_id' => $catFurniture,
                'url' => 'furniture',
                'meta_title' => 'Furniture',
                'meta_description' => 'Shop furniture',
            ],
            [
                'title' => 'Tools',
                'description' => 'Hand and power tools.',
                'category_id' => $catTools,
                'url' => 'tools',
                'meta_title' => 'Tools',
                'meta_description' => 'Shop tools',
            ],
            [
                'title' => 'Chairs',
                'description' => 'Dining and office chairs.',
                'category_id' => $catChairs,
                'url' => 'chairs',
                'meta_title' => 'Chairs',
                'meta_description' => 'Shop chairs',
            ],
        ]);

        $productChair = DB::table('product')->insertGetId([
            'price' => 129.90,
            'discount' => 10.00,
            'wholesale' => 99.00,
            'model' => 'CHAIR-001',
            'barcode' => '3800000000011',
            'weight' => 8.50,
            'youtube' => null,
            'quantity' => 25,
            'bundle_of_models' => null,
            'out_of_stock_status' => 0,
            'brand_id' => $brandNike,
            'status' => 1,
            'sort_order' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ], 'product_id');
        $productLamp = DB::table('product')->insertGetId([
            'price' => 49.90,
            'discount' => 0,
            'wholesale' => 35.00,
            'model' => 'LAMP-002',
            'barcode' => '3800000000028',
            'weight' => 1.20,
            'quantity' => 80,
            'brand_id' => $brandNike,
            'status' => 1,
            'sort_order' => 2,
            'created_at' => $now,
            'updated_at' => $now,
        ], 'product_id');
        $productHammer = DB::table('product')->insertGetId([
            'price' => 19.90,
            'discount' => 2.00,
            'wholesale' => 12.00,
            'model' => 'HAMMER-003',
            'barcode' => '3800000000035',
            'weight' => 0.80,
            'quantity' => 120,
            'brand_id' => $brandAcme,
            'status' => 1,
            'sort_order' => 3,
            'created_at' => $now,
            'updated_at' => $now,
        ], 'product_id');
        $productDesk = DB::table('product')->insertGetId([
            'price' => 299.00,
            'discount' => 30.00,
            'wholesale' => 240.00,
            'model' => 'DESK-004',
            'barcode' => '3800000000042',
            'weight' => 22.00,
            'quantity' => 8,
            'brand_id' => $brandNike,
            'status' => 1,
            'sort_order' => 4,
            'created_at' => $now,
            'updated_at' => $now,
        ], 'product_id');

        DB::table('product_description')->insert([
            [
                'product_id' => $productChair,
                'title' => 'Oak dining chair',
                'description' => 'Solid oak chair with cotton seat.',
                'tags' => 'chair,oak,dining',
                'url' => 'oak-dining-chair',
                'meta_title' => 'Oak dining chair',
                'meta_description' => 'Solid oak dining chair',
            ],
            [
                'product_id' => $productLamp,
                'title' => 'Desk lamp',
                'description' => 'Adjustable LED desk lamp.',
                'tags' => 'lamp,led,desk',
                'url' => 'desk-lamp',
                'meta_title' => 'Desk lamp',
                'meta_description' => 'LED desk lamp',
            ],
            [
                'product_id' => $productHammer,
                'title' => 'Claw hammer',
                'description' => 'Steel claw hammer with rubber grip.',
                'tags' => 'hammer,tools',
                'url' => 'claw-hammer',
                'meta_title' => 'Claw hammer',
                'meta_description' => 'Steel claw hammer',
            ],
            [
                'product_id' => $productDesk,
                'title' => 'Standing desk',
                'description' => 'Height-adjustable standing desk.',
                'tags' => 'desk,office',
                'url' => 'standing-desk',
                'meta_title' => 'Standing desk',
                'meta_description' => 'Adjustable standing desk',
            ],
        ]);

        DB::table('product_to_category')->insert([
            ['product_id' => $productChair, 'category_id' => $catFurniture],
            ['product_id' => $productChair, 'category_id' => $catChairs],
            ['product_id' => $productLamp, 'category_id' => $catFurniture],
            ['product_id' => $productHammer, 'category_id' => $catTools],
            ['product_id' => $productDesk, 'category_id' => $catFurniture],
        ]);

        DB::table('product_images')->insert([
            ['product_id' => $productChair, 'path' => '/images/products/chair-1.jpg', 'main' => 1],
            ['product_id' => $productChair, 'path' => '/images/products/chair-2.jpg', 'main' => 0],
            ['product_id' => $productLamp, 'path' => '/images/products/lamp-1.jpg', 'main' => 1],
            ['product_id' => $productHammer, 'path' => '/images/products/hammer-1.jpg', 'main' => 1],
            ['product_id' => $productDesk, 'path' => '/images/products/desk-1.jpg', 'main' => 1],
        ]);

        DB::table('product_options')->insert([
            ['product_id' => $productChair, 'option_id' => $sizeOptionId, 'option_value_id' => $sizeS, 'price' => 0, 'quantity' => 5],
            ['product_id' => $productChair, 'option_id' => $sizeOptionId, 'option_value_id' => $sizeM, 'price' => 5, 'quantity' => 12],
            ['product_id' => $productChair, 'option_id' => $sizeOptionId, 'option_value_id' => $sizeL, 'price' => 10, 'quantity' => 8],
        ]);

        DB::table('product_attributes')->insert([
            ['product_id' => $productChair, 'attribute_id' => $colorAttrId, 'attribute_value_id' => $blackValueId],
            ['product_id' => $productChair, 'attribute_id' => $sizeAttrId, 'attribute_value_id' => $cottonValueId],
            ['product_id' => $productLamp, 'attribute_id' => $colorAttrId, 'attribute_value_id' => $whiteValueId],
        ]);

        DB::table('related_products')->insert([
            ['product_id' => $productChair, 'related_id' => $productDesk],
            ['product_id' => $productDesk, 'related_id' => $productLamp],
            ['product_id' => $productLamp, 'related_id' => $productChair],
        ]);

        DB::table('product_review')->insert([
            [
                'product_id' => $productChair,
                'user_id' => $userId,
                'ip_address' => '127.0.0.1',
                'name' => 'Test User',
                'review' => 'Very sturdy, looks great in the dining room.',
                'rating' => 5,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'product_id' => $productLamp,
                'user_id' => $guestUserId,
                'ip_address' => '10.0.0.8',
                'name' => 'Maria Petrova',
                'review' => 'Bright enough for late work.',
                'rating' => 4,
                'status' => 1,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('cart_status')->insert([
            ['keyword' => 'pending', 'title' => 'Pending', 'color' => '#f59e0b'],
            ['keyword' => 'paid', 'title' => 'Paid', 'color' => '#22c55e'],
            ['keyword' => 'shipped', 'title' => 'Shipped', 'color' => '#3b82f6'],
        ]);

        $voucherCode = 'SAVE10';
        DB::table('vouchers')->insert([
            'title' => '10% off',
            'code' => $voucherCode,
            'type' => 'percent',
            'discount' => 10,
            'min_price' => 50,
            'quantity' => 100,
            'status' => 1,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $orderId = DB::table('cart')->insertGetId([
            'user_id' => $userId,
            'cart_token' => Str::random(32),
            'voucher_code' => $voucherCode,
            'active_cart' => 0,
            'token' => Str::random(32),
            'name' => 'Test User',
            'email' => 'test@example.com',
            'additional_details' => 'Leave at the door',
            'phone' => '+359888000111',
            'city' => 'Sofia',
            'address' => 'Vitosha Blvd 1',
            'company' => 'Acme Ltd',
            'payment_method' => 'card',
            'payment_status' => 'paid',
            'payment_token' => Str::random(24),
            'additional_charges' => json_encode([['title' => 'Gift wrap', 'price' => 4.90]]),
            'additional_charges_total' => 4.90,
            'weight_price' => 0,
            'delivery_method' => 'econt',
            'external_delivery_method' => 'econt_office',
            'delivery_price' => 6.90,
            'tracking_number' => 'EC123456789BG',
            'status' => 'paid',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $guestCartId = DB::table('cart')->insertGetId([
            'user_id' => null,
            'cart_token' => Str::random(32),
            'voucher_code' => null,
            'active_cart' => 1,
            'token' => Str::random(32),
            'name' => 'Guest Buyer',
            'email' => 'guest@example.com',
            'phone' => '+359888000333',
            'city' => 'Varna',
            'address' => 'Sea Garden 5',
            'company' => '',
            'payment_method' => 'cod',
            'payment_status' => 'pending',
            'delivery_method' => 'speedy',
            'delivery_price' => 7.50,
            'status' => 'pending',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('cart_products')->insert([
            [
                'cart_id' => $orderId,
                'product_id' => $productChair,
                'title' => 'Oak dining chair',
                'quantity' => 2,
                'image' => '/images/products/chair-1.jpg',
                'weight' => 8.50,
                'price' => 129.90,
                'option_price_total' => 10.00,
                'options' => json_encode(['Size' => 'L']),
                'options_ids' => (string) $sizeL,
                'discount' => 10.00,
                'total' => 259.80,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'cart_id' => $orderId,
                'product_id' => $productLamp,
                'title' => 'Desk lamp',
                'quantity' => 1,
                'image' => '/images/products/lamp-1.jpg',
                'weight' => 1.20,
                'price' => 49.90,
                'option_price_total' => 0,
                'options' => null,
                'options_ids' => null,
                'discount' => 0,
                'total' => 49.90,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'cart_id' => $guestCartId,
                'product_id' => $productHammer,
                'title' => 'Claw hammer',
                'quantity' => 1,
                'image' => '/images/products/hammer-1.jpg',
                'weight' => 0.80,
                'price' => 19.90,
                'option_price_total' => 0,
                'options' => null,
                'options_ids' => null,
                'discount' => 2.00,
                'total' => 19.90,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('cart_notes')->insert([
            'cart_id' => $orderId,
            'note' => 'Customer asked for weekend delivery.',
            'status' => 'open',
            'date_added' => $now,
        ]);

        DB::table('cart_invoices')->insert([
            'order_cart_token' => 'INV-2026-0001',
            'order_cart_id' => $orderId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('return_order')->insert([
            'order_id' => $orderId,
            'name' => 'Test User',
            'email' => 'test@example.com',
            'status' => 0,
            'phone' => '+359888000111',
            'reason' => 'Wrong size',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('email_history')->insert([
            'order_id' => $orderId,
            'email' => 'test@example.com',
            'subject' => 'Your order has been paid',
            'body' => 'Thanks for your order #'.$orderId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('settings')->insert([
            'title' => 'Shop v2',
            'description' => 'Local demo shop API',
            'about_us' => 'We sell furniture and tools.',
            'phone' => '+359888111222',
            'website_name' => 'shop-v2.test',
            'website_company' => 'Shop V2 EOOD',
            'email_address' => 'hello@shop-v2.test',
            'logo' => '/images/logo.png',
            'default_image' => '/images/placeholder.png',
            'favicon' => '/images/favicon.ico',
            'primary_color' => '#111827',
            'secondary_color' => '#f97316',
            'address' => 'Sofia, Bulgaria',
        ]);

        DB::table('cities')->insert([
            ['name' => 'Sofia', 'region' => 'Sofia-grad'],
            ['name' => 'Plovdiv', 'region' => 'Plovdiv'],
            ['name' => 'Varna', 'region' => 'Varna'],
        ]);

        DB::table('contacts')->insert([
            'name' => 'Ivan Dimitrov',
            'email' => 'ivan@example.com',
            'phone' => '+359888444555',
            'title' => 'Delivery question',
            'description' => 'Do you ship to Burgas?',
            'read' => 0,
            'answer_email_sent' => 0,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('information')->insert([
            [
                'title' => 'Privacy policy',
                'thumbnail' => null,
                'description' => 'Dummy privacy policy text.',
                'status' => 1,
                'agreements_at_order' => 1,
                'agreement_at_contacts' => 1,
                'show_in_footer' => 1,
                'sort_order' => 1,
                'url' => 'privacy-policy',
                'meta_title' => 'Privacy policy',
                'meta_description' => 'Privacy policy',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'title' => 'Terms of service',
                'thumbnail' => null,
                'description' => 'Dummy terms of service text.',
                'status' => 1,
                'agreements_at_order' => 1,
                'agreement_at_contacts' => 0,
                'show_in_footer' => 1,
                'sort_order' => 2,
                'url' => 'terms-of-service',
                'meta_title' => 'Terms of service',
                'meta_description' => 'Terms of service',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        $postCatNews = DB::table('post_categories')->insertGetId([
            'title' => 'News',
            'status' => 1,
            'image' => '/images/blog/news.jpg',
            'sort_order' => 1,
            'url' => 'news',
            'meta_title' => 'News',
            'meta_description' => 'Shop news',
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $postId = DB::table('posts')->insertGetId([
            'type' => 'blog',
            'category_id' => $postCatNews,
            'image' => '/images/blog/welcome.jpg',
            'contact_form' => 0,
            'archived' => 0,
            'status' => 1,
            'sort_order' => 1,
            'views' => 12,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $postContentBg = DB::table('posts_content')->insertGetId([
            'title' => 'Добре дошли в магазина',
            'post_id' => $postId,
            'language' => 'bg',
            'url' => 'dobre-doshli',
            'meta_title' => 'Добре дошли',
            'meta_description' => 'Новини от магазина',
        ]);
        $postContentEn = DB::table('posts_content')->insertGetId([
            'title' => 'Welcome to the shop',
            'post_id' => $postId,
            'language' => 'en',
            'url' => 'welcome-to-the-shop',
            'meta_title' => 'Welcome',
            'meta_description' => 'Shop news',
        ]);

        DB::table('posts_content_components')->insert([
            [
                'post_content_id' => $postContentEn,
                'title' => 'Intro',
                'type' => 'text',
                'content' => 'This is a dummy blog post for the API.',
                'sort_order' => 1,
                'size' => 12,
                'displayTitle' => 1,
                'visible' => 1,
            ],
            [
                'post_content_id' => $postContentBg,
                'title' => 'Въведение',
                'type' => 'text',
                'content' => 'Това е демо публикация.',
                'sort_order' => 1,
                'size' => 12,
                'displayTitle' => 1,
                'visible' => 1,
            ],
        ]);

        DB::table('discount_history')->insert([
            'categories' => json_encode([$catFurniture, $catChairs]),
            'percent' => 15,
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('modules')->insert([
            [
                'title' => 'Homepage slider',
                'url' => '/admin/modules/slider',
                'type' => 'module',
                'icon' => 'image',
                'description' => 'Hero banners',
                'code' => 'slider',
                'global_status' => 1,
                'status' => 1,
                'content' => json_encode(['slides' => 3]),
            ],
            [
                'title' => 'Featured products',
                'url' => '/admin/modules/featured',
                'type' => 'module',
                'icon' => 'star',
                'description' => 'Featured product grid',
                'code' => 'featured',
                'global_status' => 1,
                'status' => 1,
                'content' => json_encode(['limit' => 8]),
            ],
        ]);

        DB::table('email_templates')->insert([
            [
                'title' => 'Order paid',
                'description' => 'Hello {name}, your order {order_id} is paid.',
                'for' => 'order_paid',
                'allowed_tags' => 'name,order_id',
            ],
            [
                'title' => 'Welcome',
                'description' => 'Welcome {name}!',
                'for' => 'register',
                'allowed_tags' => 'name',
            ],
        ]);

        DB::table('importer')->insert([
            'name' => 'Demo XML feed',
            'jsonFile' => 'imports/demo.json',
            'jsonProductKey' => 'products',
            'category_id' => (string) $catTools,
            'storeKeys' => json_encode(['model', 'price', 'quantity']),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        $roomId = DB::table('rooms')->insertGetId([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'status' => 1,
            'token' => Str::random(32),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('room_messages')->insert([
            [
                'room_id' => $roomId,
                'sender' => 'guest',
                'message' => 'Hi, is the chair still in stock?',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'room_id' => $roomId,
                'sender' => 'admin',
                'message' => 'Yes, we have 25 left.',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);

        DB::table('messages_faq')->insert([
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('compare_products')->insert([
            'user_token' => Str::random(24),
            'products' => implode(',', [$productChair, $productDesk]),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('yanak_soft')->insert([
            'username' => 'demo',
            'email' => 'yanak@example.com',
            'bearer_token' => Str::random(48),
            'token_expires_at' => $now->copy()->addDay()->toDateTimeString(),
        ]);

        DB::table('password_resets')->insert([
            'email' => 'test@example.com',
            'token' => Str::random(64),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('design_and_settings')->insert([
            'code' => 'homepage',
            'json' => json_encode(['layout' => 'grid', 'per_page' => 24]),
        ]);

        DB::table('storage')->insert([
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('localisation')->insert([
            'title' => 'Български',
            'language_code' => 'bg',
            'image' => '/images/flags/bg.png',
            'status' => 1,
            'primary' => 1,
        ]);
        DB::table('localisation')->insert([
            'title' => 'English',
            'language_code' => 'en',
            'image' => '/images/flags/en.png',
            'status' => 1,
            'primary' => 0,
        ]);

        DB::table('currency')->insert([
            ['title' => 'Bulgarian Lev', 'code' => 'BGN', 'symbol' => 'лв', 'conversion' => 1, 'primary' => 1],
            ['title' => 'Euro', 'code' => 'EUR', 'symbol' => '€', 'conversion' => 2, 'primary' => 0],
        ]);

        DB::table('newsletter')->insert([
            ['email' => 'test@example.com', 'subscribed' => 1, 'created_at' => $now, 'updated_at' => $now],
            ['email' => 'maria@example.com', 'subscribed' => 1, 'created_at' => $now, 'updated_at' => $now],
        ]);

        DB::table('localisation_translates')->insert([
            [
                'title' => 'Oak dining chair',
                'description' => 'Solid oak chair with cotton seat.',
                'type' => 'product',
                'item_id' => $productChair,
                'locale' => 'en',
            ],
            [
                'title' => 'Трапезен стол от дъб',
                'description' => 'Стол от масив дъб с памучна седалка.',
                'type' => 'product',
                'item_id' => $productChair,
                'locale' => 'bg',
            ],
        ]);

        DB::table('exporter')->insert([
            'title' => 'Google Merchant',
            'token' => Str::random(32),
            'json' => json_encode(['format' => 'xml', 'fields' => ['title', 'price']]),
            'created_at' => $now,
            'updated_at' => $now,
        ]);

        DB::table('analytics')->insert([
            ['views' => 140, 'item_id' => $productChair, 'item_type' => 'product'],
            ['views' => 12, 'item_id' => $postId, 'item_type' => 'post'],
        ]);

        DB::table('notes')->insert([
            'belongs_to' => 'cart',
            'resource_id' => (string) $orderId,
            'note' => 'VIP customer — pack carefully.',
            'user_id' => $adminId,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
