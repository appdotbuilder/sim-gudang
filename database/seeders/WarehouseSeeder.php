<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\IncomingGoods;
use App\Models\OutgoingGoods;
use App\Models\DeliveryOrder;
use App\Models\Invoice;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@warehouse.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create warehouse staff user
        $staff = User::create([
            'name' => 'Warehouse Staff',
            'email' => 'staff@warehouse.com',
            'password' => Hash::make('staff123'),
            'role' => 'warehouse_staff',
            'email_verified_at' => now(),
        ]);

        // Create categories
        $electronics = Category::create([
            'name' => 'Electronics',
            'description' => 'Electronic devices and components',
            'code' => 'ELE',
        ]);

        $furniture = Category::create([
            'name' => 'Furniture',
            'description' => 'Office and home furniture',
            'code' => 'FUR',
        ]);

        $stationery = Category::create([
            'name' => 'Stationery',
            'description' => 'Office supplies and stationery items',
            'code' => 'STA',
        ]);

        // Create products
        $products = collect([
            [
                'name' => 'Laptop Computer',
                'description' => 'Business laptop with 16GB RAM',
                'category_id' => $electronics->id,
                'stock_quantity' => 25,
                'minimum_stock' => 5,
                'unit' => 'pcs',
                'unit_price' => 15000.00,
            ],
            [
                'name' => 'Office Chair',
                'description' => 'Ergonomic office chair with lumbar support',
                'category_id' => $furniture->id,
                'stock_quantity' => 8,
                'minimum_stock' => 10, // Low stock
                'unit' => 'pcs',
                'unit_price' => 2500.00,
            ],
            [
                'name' => 'Wireless Mouse',
                'description' => 'Bluetooth wireless mouse',
                'category_id' => $electronics->id,
                'stock_quantity' => 0, // Out of stock
                'minimum_stock' => 15,
                'unit' => 'pcs',
                'unit_price' => 350.00,
            ],
            [
                'name' => 'A4 Paper',
                'description' => 'White A4 copy paper, 80gsm',
                'category_id' => $stationery->id,
                'stock_quantity' => 150,
                'minimum_stock' => 20,
                'unit' => 'pack',
                'unit_price' => 45.00,
            ],
        ]);

        foreach ($products as $productData) {
            $productData['code'] = 'PRD-' . strtoupper(uniqid());
            Product::create($productData);
        }

        // Create some incoming goods records
        $products = Product::all();
        foreach ($products as $product) {
            IncomingGoods::create([
                'reference_number' => 'IN-' . now()->format('Ymd') . '-' . str_pad((string) random_int(1, 9999), 4, '0', STR_PAD_LEFT),
                'product_id' => $product->id,
                'quantity' => random_int(10, 50),
                'supplier' => 'Supplier ' . random_int(1, 5),
                'notes' => 'Initial stock received',
                'received_date' => now()->subDays(random_int(1, 30)),
                'user_id' => $staff->id,
            ]);
        }

        // Create some outgoing goods records
        foreach ($products->where('stock_quantity', '>', 0) as $product) {
            OutgoingGoods::create([
                'reference_number' => 'OUT-' . now()->format('Ymd') . '-' . str_pad((string) random_int(1, 9999), 4, '0', STR_PAD_LEFT),
                'product_id' => $product->id,
                'quantity' => random_int(1, min(5, $product->stock_quantity)),
                'customer' => 'Customer ' . random_int(1, 10),
                'notes' => 'Regular sale',
                'shipped_date' => now()->subDays(random_int(1, 15)),
                'status' => collect(['pending', 'shipped', 'delivered'])->random(),
                'user_id' => $staff->id,
            ]);
        }
    }
}