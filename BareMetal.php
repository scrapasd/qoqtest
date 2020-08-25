<?php

use Illuminate\Database\Seeder;

use App\Models\User;

use Illuminate\Support\Facades\Log;

class BareMetal extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create a vendor
        Log::info("creating vendor");
        $user = User::create([
            'email' => 'asd@gmail.com',
            'first_name' => 'asd',
            'last_name' => 'test',
            'password' => 'asd123'
        ]);
        $user->vendors()->create([
            'email' => 'asd@gmail.com',
            'first_name' => 'asd',
            'last_name' => 'test',
            'business_name' => 'asd store',
            'is_active' => true,
            'gstin' => 'abcde2234567890',
            'vendor_type' => 'grocery',
            'state_code' => 32,
            'state' => 'kerala',
            'locality' => 'ottapalam',
            'address' => 'pkd-10,central mall'
        ]);

        //create a category
        Log::info("creating a category and product under vendor");
        $vendor = $user->vendors()->first();
        $category = $vendor->categories()->create(['name' => 'grocery']);
        //create a product
        $category_id = $category->id;
        $vendor->products()->createMany([
            [
                'name' => 'kuruva rice',
                'selling_price' => 35,
                'mrp' => 40,
                'available_qty' => 100,
                'category_id' => $category_id
            ], [
                'name' => 'maggi noodles',
                'selling_price' => 40,
                'mrp' => 45,
                'available_qty' => 100,
                'category_id' => $category_id
            ],
            [
                'name' => 'kothuku thiri',
                'selling_price' => 20,
                'mrp' => 20,
                'available_qty' => 100,
                'category_id' => $category_id
            ]
        ]);

        Log::info('creating a user');
        //create a User,auto-verified
        User::create([
            'email' => 'user@gmail.com',
            'first_name' => 'user00',
            'last_name' => 'kk',
            'password' => 'asd123',
            'is_verified' => true
        ]);
    }
}
