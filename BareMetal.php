<?php

use Illuminate\Database\Seeder;

use App\Models\User;

use Illuminate\Support\Facades\DB;

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
        $user = User::create([
            'email' => 'asd@gmail.com',
            'first_name' => 'asd',
            'last_name' => 'test',
            'password' => 'asd123'
        ]);


        $places = [
            'ponnamkode' => ['long' => 76.517624, 'lat' => 10.947598],
            'kalladikode' => ['long' => 76.532714, 'lat' => 10.896188],
            'thachampara' => ['long' => 76.502781, 'lat' => 10.959141],
            'mannarkkad' => ['long' => 76.456860, 'lat' => 10.992900],
            'nellipuzha' => ['long' => 76.46865915689449, 'lat' => 10.9936768],
            'palakkad' => ['long' => 76.651247, 'lat' => 10.769199],
            'perinthalmanna' => ['long' => 76.2265374, 'lat' => 10.9753792],
            'calicut' => ['long' => 75.775937, 'lat' => 11.244614]
        ];


        foreach ($places as $key => $value) {

            $vendor = $user->vendors()->create([
                'email' => $key . '@gmail.com',
                'first_name' => 'asd',
                'last_name' => 'test',
                'business_name' => $key . ' store',
                'is_active' => true,
                'gstin' => 'abcde2234567890',
                'vendor_type' => 'grocery',
                'state_code' => 32,
                'state' => 'kerala',
                'locality' => $key,
                'address' => $key
            ]);
            $longitude = $value['long'];
            $latitude = $value['lat'];

            DB::statement("UPDATE vendors SET geo_location = ST_SetSRID(ST_MakePoint('$longitude','$latitude'), 4326) WHERE id='$vendor->id';");
        }


        //create a category
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
