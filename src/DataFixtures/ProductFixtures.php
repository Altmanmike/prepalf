<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use App\Entity\Product;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $productsList = [
            [
                'name' => 'Lord Of The Ring Book',
                'price' => 39.99,
                'stock' => 8
            ],
            [
                'name' => 'Star Wars DvD Collection',
                'price' => 200.00,
                'stock' => 3
            ],
            [
                'name' => 'Cheese for pizza',
                'price' => 9.25,
                'stock' => 23
            ],
            [
                'name' => 'Candum',
                'price' => 15.50,
                'stock' => 16
            ],
            [
                'name' => 'Sweat shirt',
                'price' => 25.50,
                'stock' => 5
            ]
            
        ];
        
        $i=0;
        foreach ($productsList as $p) {
            $product = new Product();
            $product->setName($p['name'])
                ->setPrice($p['price'])
                ->setStock($p['stock'])         
                ->setCreatedAt(new \DatetimeImmutable())
                ->setUpdatedAt(new \DatetimeImmutable());

                if ($i === 0) {
                   $product->addTag($this->getReference('tag_0', Tag::class))
                        ->addTag($this->getReference('tag_2', Tag::class)); 
                }

                if ($i === 1) {
                    $product->addTag($this->getReference('tag_0', Tag::class))
                        ->addTag($this->getReference('tag_1', Tag::class))
                        ->addTag($this->getReference('tag_2', Tag::class))
                        ->addTag($this->getReference('tag_3', Tag::class));
                }

                if ($i === 2) {
                    $product->addTag($this->getReference('tag_4', Tag::class))
                        ->addTag($this->getReference('tag_5', Tag::class));
                }

                if ($i === 3) {
                    $product->addTag($this->getReference('tag_3', Tag::class));                    
                }
                
                if ($i === 4) {
                    $product->addTag($this->getReference('tag_6', Tag::class));
                }
                
            $manager->persist($product);
            $i++;
        }

        $manager->flush();
           
    }

    public function getDependencies(): array
    {
        return [
            TagFixtures::class
        ]; 
    }
}