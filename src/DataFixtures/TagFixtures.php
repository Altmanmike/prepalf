<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use App\Entity\Product;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class TagFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $tagsList = [
            [                    
                'name' => 'Adventures',
                'description' => 'Some actions',
            ],
            [                    
                'name' => 'Futuristic',
                'description' => 'scify',
            ],
            [                    
                'name' => 'War',
                'description' => 'fights',
            ],
            [                    
                'name' => 'Love',
                'description' => '2 persons',
            ],
            [                    
                'name' => 'Food',
                'description' => 'to eat some',
            ],
            [                    
                'name' => 'Bio',
                'description' => 'from farm',
            ],
            [                    
                'name' => 'Wear',
                'description' => 'too cold',
            ]            
        ];

        $i=0;
        foreach ($tagsList as $t) {            
            $tag = new Tag();
            $tag->setName($t['name'])
                ->setdescription($t['description'])
                ->setCreatedAt(new \DatetimeImmutable())
                ->setUpdatedAt(new \DatetimeImmutable());
            $this->addReference('tag_'.$i, $tag);
            
            $manager->persist($tag);
            $i++;
        }
        
        $manager->flush();
           
    }
}