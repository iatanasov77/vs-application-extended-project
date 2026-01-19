<?php namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Sylius\Component\Resource\Repository\RepositoryInterface;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchProductForm extends AbstractType
{
    /** @var string */
    private $productCategoryClass;
    
    public function __construct( string $productCategoryClass )
    {
        $this->productCategoryClass = $productCategoryClass;
    }
    
    public function buildForm( FormBuilderInterface $builder, array $options ): void
    {
        $builder
            ->add( 'search', TextType::class, [
                'translation_domain'    => 'VankosoftApplication',
            ])
            
            ->add( 'category', EntityType::class, [
                'translation_domain'    => 'VankosoftApplication',
                'class'                 => $this->productCategoryClass,
                'choice_label'          => 'name',
                'placeholder'           => 'vs_app.form.product_search.category_placeholder'
            ])
            
            ->add( 'submit', SubmitType::class, [
                'label'                 => 'vs_app.form.product_search.apply',
                'translation_domain'    => 'VankosoftApplication',
            ])
        ;
    }
    
    public function configureOptions( OptionsResolver $resolver ): void
    {
        $resolver
            ->setDefaults([
                'csrf_protection'   => false,
            ])
        ;
    }
}
