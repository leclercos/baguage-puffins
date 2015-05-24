<?php
namespace Parc\PuffinsBagBundle\Form\Extension;
 
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
 
class HelpTypeExtension extends AbstractTypeExtension
{
    public function getExtendedType()
    {
        return 'form';
    }
 
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_merge($view->vars, array('help' => $options['help'],'image_path' => $options['image_path']));
    }
 
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array('help' => null,'image_path' => null));
    }
}
