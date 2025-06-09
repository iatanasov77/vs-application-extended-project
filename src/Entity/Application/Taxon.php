<?php namespace App\Entity\Application;

use Doctrine\ORM\Mapping as ORM;
use Vankosoft\ApplicationBundle\Model\Taxon as BaseTaxon;

//use Sylius\Component\Taxonomy\Model\TaxonTranslationInterface;
use Vankosoft\ApplicationBundle\Model\Interfaces\TaxonTranslationInterface;

/**
 * @Doctrine\Common\Annotations\Annotation\IgnoreAnnotation( "ORM\MappedSuperclass" )
 * @Doctrine\Common\Annotations\Annotation\IgnoreAnnotation("ORM\Column")
 */
#[ORM\Entity]
#[ORM\Table(name: "VSAPP_Taxons")]
class Taxon extends BaseTaxon
{
    /**
     * Dont Move This to VankosoftApplication Library.
     * See Sylius Standard Project.
     *
     * {@inheritDoc}
     * @see \Vankosoft\ApplicationBundle\Model\Taxon::createTranslation()
     */
    protected function createTranslation(): TaxonTranslationInterface
    {
        $translation   = new TaxonTranslation();
        $translation->setLocale( 'en_US' );
        $translation->setTranslatable( $this );
        
        return $translation;
    }
}
