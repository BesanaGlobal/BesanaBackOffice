<?php

namespace App\Helper;

class Data 
{


     static function getData()
    {
        return  $data = [

          [
             'id'   => 1,
             'name' => 'Jhon Carter',
             'nivel' => 'Father',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/partner/1.jpg",
             'rank'=>'oro'

          
            ],
            [
         
              'id'   => 2,
              'pid'  => 1,//id del padre
              'name' => 'Nelly Sack',
              'nivel' => 'Child',
              'email' => 'carter@email.com',
              'phone' => 236567787,
              'img'   => "img/partner/2.jpg",
             'rank'=>'oro'

             
      
             ],
           [
             'id'   => 3,
             'pid'  => 1,
             'name' => 'Carl Michel',
             'nivel' => 'Child',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/partner/3.jpg",
             'rank'=>'oro'

            ],
           [
         
             'id'   => 4,
             'pid'  => 2,
             'name' => 'Amelia Tylor',
             'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/logonew.png",
             'rank'=>'oro'

           
            ],
           [
         
             'id'   => 5,
             'pid'  => 2,
             'name' => 'Lian Brown',
             'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/partner/5.jpg",
             'rank'=>'oro'

           
     
            ],
           
            [
         
            'id'   => 6,
            'pid'  => 3,
            'name' => 'Emma Smith',
            'nivel' => 'Grandchild',
            'email' => 'carter@email.com',
            'phone' => 236567787,
            'img'   => "img/partner/6.jpg",
            'rank'=>'oro'

              
        
               ],
              [
            
            'id'   => 7,
            'pid'  => 3,
            'name' => 'Paul Walker',
            'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/logonew.png",
             'rank'=>'oro'

              
               ],
               
              [
            
            'id'   => 8,
            'pid'  => 4,
            'name' => 'Paul Walker',
            'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/partner/8.jpg",
             'rank'=>'oro'

              
               ],

              [
            
            'id'   => 9,
            'pid'  => 4,
            'name' => 'Paul Walker',
            'nivel' => 'Grandchild',
             'email' => 'carter@email.com',
             'phone' => 236567787,
             'img'   => "img/partner/7.jpg",
             'rank'=>'oro'
              
               ],
            
         ];
    }
}