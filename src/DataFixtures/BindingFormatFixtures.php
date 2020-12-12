<?php

namespace App\DataFixtures;

use App\Entity\BindingFormat;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

/**
 * Class BindingFormatFixtures
 * @package App\DataFixtures
 */
class BindingFormatFixtures extends Fixture
{
    /**
     *
     */
    const BINDING_FORMATS = ['In-plano', 'In-folio', 'In-quarto', 'In-6', 'In-octavo', 'In-douze', 'In-16'];

    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        foreach (self::BINDING_FORMATS as $formatName) {
            $bindingFormat = new BindingFormat();
            $bindingFormat->setName($formatName);
            $manager->persist($bindingFormat);
        }

        $manager->flush();
    }
}