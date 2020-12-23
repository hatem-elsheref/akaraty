<?php

use Illuminate\Database\Seeder;
use \Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\RealEstate;
use App\Models\Image;
class RealEstateTableSeeder extends Seeder
{

    public function run(Faker $facker)
    {

          foreach (range(1,20) as $iteration){
            $title=$facker->sentence(2);
            $category=['buy','rent'];
            $status=['available','busy','sold'];
            $type=['apartment','building'];

            $randomForCategory  =array_rand($category,1);
            $randomForStatus    =array_rand($status,1);
            $randomForType      =array_rand($type,1);

            $start=null;
            $end=null;


            if ($category[$randomForCategory] == 'buy'){
                $randomForStatus='available';
            }else{
                if ($status[$randomForStatus] == 'busy'){
                    $randomForStatus='busy';
                    $start=now()->subDays(12);
                    $end=now()->addMonths(3);
                }else{
                    $randomForStatus='available';
                    $start=null;
                    $end=null;
                }

            }







            $item=RealEstate::create([
                'user_id'                       =>2,
                'state_id'                      =>rand(1040,1060),
                'title'                         =>$title,
                'slug'                          =>Str::slug($title.'-'.rand(1,500)),
                'description'                   =>$facker->sentence(60),
                'address'                       =>$facker->address,
                'area'                          =>rand(1,800),
                'price'                         =>rand(1,8000),
                'category'                      =>$category[$randomForCategory],
                'status'                        =>$randomForStatus,
                'type'                          =>$type[$randomForType],
                'start_rent_date'               =>$start,
                'end_rent_date'                 =>$end,
                'has_pool'                      =>true,
                'has_cleaning'                  =>true,
                'has_internet'                  =>false,
                'has_kitchen'                   =>true,
                'has_parking'                   =>true,
                'has_garage'                    =>true,
                'floors_number'                 =>rand(1,5),
                'flats_number'                  =>rand(1,5),
                'bed_room_number'               =>3,
                'bath_room_number'              =>2,
                'living_room_number'            =>5,
//                'lat'                           =>$facker->latitude,
//                'long'                          =>$facker->longitude,
//                'video'                         =>$facker->word,
            ]);
            $images=[
                [
                    'src'=>'uploads/real_estates/'.$item->id.'/1.jpg',
                    'real_estate_id'=>$item->id
                ],
                [
                    'src'=>'uploads/real_estates/'.$item->id.'/2.jpg',
                    'real_estate_id'=>$item->id
                ],
                [
                    'src'=>'uploads/real_estates/'.$item->id.'/3.jpg',
                    'real_estate_id'=>$item->id
                ],
            ];
            Image::insert($images);
            $path='uploads/real_estates/'.$item->id;
              \Illuminate\Support\Facades\Storage::disk('my_desk')->deleteDirectory($path);
              \Illuminate\Support\Facades\Storage::disk('my_desk')->makeDirectory($path);
              \Illuminate\Support\Facades\Storage::disk('my_desk')->copy('assets/facker/1.jpg',$path.'/1.jpg');
              \Illuminate\Support\Facades\Storage::disk('my_desk')->copy('assets/facker/2.jpg',$path.'/2.jpg');
              \Illuminate\Support\Facades\Storage::disk('my_desk')->copy('assets/facker/3.jpg',$path.'/3.jpg');

        }



          foreach (range(1,10) as $iteration){
            $title=$facker->sentence(2);

              $randomForType      ='land';
              $randomForCategory  ='buy';
              $randomForStatus    =null;
              $start=null;
              $end=null;

;


            $item=RealEstate::create([
                'user_id'                       =>2,
                'state_id'                      =>rand(1040,1060),
                'title'                         =>$title,
                'slug'                          =>Str::slug($title.'-'.rand(1,500)),
                'description'                   =>$facker->sentence(60),
                'address'                       =>$facker->address,
                'area'                          =>$facker->randomFloat(2,0,3000),
                'price'                         =>rand(1,8000),
                'category'                      =>$randomForCategory,
                'status'                        =>$randomForStatus,
                'type'                          =>$randomForType,
                'start_rent_date'               =>$start,
                'end_rent_date'                 =>$end,
                'has_pool'                      =>false,
                'has_cleaning'                  =>false,
                'has_internet'                  =>false,
                'has_kitchen'                   =>false,
                'has_parking'                   =>false,
                'has_garage'                    =>false,
                'floors_number'                 =>null,
                'bed_room_number'               =>null,
                'bath_room_number'              =>null,
                'living_room_number'            =>null,
//                'lat'                           =>$facker->latitude,
//                'long'                          =>$facker->longitude,
//                'video'                         =>$facker->word,
            ]);
            $images=[
                [
                    'src'=>'uploads/real_estates/'.$item->id.'/1.jpg',
                    'real_estate_id'=>$item->id
                ],
                [
                    'src'=>'uploads/real_estates/'.$item->id.'/2.jpg',
                    'real_estate_id'=>$item->id
                ],
                [
                    'src'=>'uploads/real_estates/'.$item->id.'/3.jpg',
                    'real_estate_id'=>$item->id
                ],
            ];
            Image::insert($images);
            $path='uploads/real_estates/'.$item->id;
              \Illuminate\Support\Facades\Storage::disk('my_desk')->deleteDirectory($path);
              \Illuminate\Support\Facades\Storage::disk('my_desk')->makeDirectory($path);
            \Illuminate\Support\Facades\Storage::disk('my_desk')->copy('assets/facker/1.jpg',$path.'/1.jpg');
            \Illuminate\Support\Facades\Storage::disk('my_desk')->copy('assets/facker/2.jpg',$path.'/2.jpg');
            \Illuminate\Support\Facades\Storage::disk('my_desk')->copy('assets/facker/3.jpg',$path.'/3.jpg');

        }



    }
}
