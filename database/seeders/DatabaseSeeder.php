<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\{
    User, Category, Destination, TourPackage, PackageImage, ItineraryItem, PackageSchedule
};
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin default
        User::updateOrCreate(['email'=>'admin@tripgo.local'],[
            'name'=>'Admin TripGo',
            'password'=>Hash::make('TripGo123!'),
            'role'=>'admin'
        ]);

        // Kategori
        $catOpen   = Category::firstOrCreate(['slug'=>'open-trip'], ['name'=>'Open Trip']);
        $catPrivate= Category::firstOrCreate(['slug'=>'private'],    ['name'=>'Private']);
        $catFamily = Category::firstOrCreate(['slug'=>'family'],     ['name'=>'Family']);

        // Destinasi
        $destinations = [
            ['slug'=>'bali','name'=>'Bali','country'=>'Indonesia','city'=>'Badung'],
            ['slug'=>'labuan-bajo','name'=>'Labuan Bajo','country'=>'Indonesia','city'=>'Manggarai Barat'],
            ['slug'=>'yogyakarta','name'=>'Yogyakarta','country'=>'Indonesia','city'=>'Yogyakarta'],
            ['slug'=>'raja-ampat','name'=>'Raja Ampat','country'=>'Indonesia','city'=>'Waigeo'],
            ['slug'=>'lombok','name'=>'Lombok','country'=>'Indonesia','city'=>'Mataram'],
        ];
        foreach ($destinations as $d) {
            Destination::firstOrCreate(['slug'=>$d['slug']], $d);
        }

        // Helper ambil ID destinasi
        $D = fn($slug)=>Destination::where('slug',$slug)->first()->id;

        // Daftar paket (judul, slug, kategori, destinasi, harga, durasi, short_desc, deskripsi)
        $packages = [
            ['Bali 3D2N Hemat','bali-3d2n',$catOpen->id,$D('bali'),1500000,3,'Liburan hemat 3 hari 2 malam di Bali','Termasuk hotel, sarapan, Ubud & Tanah Lot'],
            ['Labuan Bajo 4D3N Komodo','labuan-bajo-4d3n',$catOpen->id,$D('labuan-bajo'),3800000,4,'Sailing Komodo + Pink Beach','Speedboat trip, snorkeling manta point, makan siang kapal'],
            ['Yogyakarta 3D2N Heritage','yogyakarta-3d2n',$catFamily->id,$D('yogyakarta'),1200000,3,'Candi & kuliner Yogya','Prambanan, Keraton, Malioboro, Gudeg'],
            ['Raja Ampat 5D4N Explore','raja-ampat-5d4n',$catPrivate->id,$D('raja-ampat'),8200000,5,'Surga bawah laut Papua','Wayag, Pianemo, snorkeling karst islands'],
            ['Lombok 4D3N Pantai','lombok-4d3n',$catOpen->id,$D('lombok'),2600000,4,'Pantai selatan & Gili','Tanjung Aan, Merese, Gili T, snorkeling'],
        ];

        // Kumpulan gambar untuk tiap paket (pakai URL bebas/unsplash)
        $images = [
            'bali-3d2n' => [
                'https://images.unsplash.com/photo-1500530855697-b586d89ba3ee',
                'https://images.unsplash.com/photo-1543248939-ff40856f65d4',
                'https://images.unsplash.com/photo-1506744038136-46273834b3fb',
            ],
            'labuan-bajo-4d3n' => [
                'https://images.unsplash.com/photo-1558981403-c5f9899a28bc',
                'https://images.unsplash.com/photo-1537996194471-e657df975ab4',
                'https://images.unsplash.com/photo-1558981359-98d66f2b22c8',
            ],
            'yogyakarta-3d2n' => [
                'https://images.unsplash.com/photo-1600585154526-990dced4db0d',
                'https://images.unsplash.com/photo-1612152605546-2400bd0c1b3e',
            ],
            'raja-ampat-5d4n' => [
                'https://images.unsplash.com/photo-1507525428034-b723cf961d3e',
                'https://images.unsplash.com/photo-1526483360412-f4dbaf036963',
                'https://images.unsplash.com/photo-1526772662000-3f88f10405ff',
            ],
            'lombok-4d3n' => [
                'https://images.unsplash.com/photo-1518684079-3c830dcef090',
                'https://images.unsplash.com/photo-1549880338-65ddcdfd017b',
                'https://images.unsplash.com/photo-1500534314209-a25ddb2bd429',
            ],
        ];

        foreach ($packages as [$title,$slug,$catId,$destId,$price,$days,$short,$desc]) {
            $pkg = TourPackage::firstOrCreate(['slug'=>$slug], [
                'category_id'=>$catId,
                'destination_id'=>$destId,
                'title'=>$title,
                'short_desc'=>$short,
                'description'=>$desc,
                'base_price'=>$price,
                'duration_days'=>$days,
                'is_active'=>true,
            ]);

            // Itinerary sederhana
            for ($d=1; $d<=$days; $d++) {
                ItineraryItem::firstOrCreate(
                    ['tour_package_id'=>$pkg->id,'day_number'=>$d],
                    ['title'=>"Hari $d", 'description'=>"Kegiatan wisata hari $d di $pkg->title"]
                );
            }

            // Jadwal (3 keberangkatan mendatang)
            foreach ([7, 21, 35] as $plus) {
                PackageSchedule::firstOrCreate(
                    ['tour_package_id'=>$pkg->id,'depart_date'=>Carbon::now()->addDays($plus)->toDateString()],
                    ['seats_quota'=>24]
                );
            }

            // Gambar
            foreach (($images[$slug] ?? []) as $url) {
                PackageImage::firstOrCreate(
                    ['tour_package_id'=>$pkg->id,'path'=>$url],
                    []
                );
            }
        }
    }
}
