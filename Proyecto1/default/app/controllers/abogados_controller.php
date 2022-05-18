<?php

class AbogadosController extends AppController
{
    public function index()
    {
         
    }

    public function create()
    {
      
        if (Input::hasPost('Abogados')) {
           
            $menu = new Abogados(Input::post('Abogados'));
            //En caso que falle la operación de guardar
            if ($menu->create()) {
                Flash::valid('Operación exitosa');
                //Eliminamos el POST, si no queremos que se vean en el form
                Input::delete();
                return;
            }
 
            Flash::error('Falló Operación');
        }
    }

    public function editar($IDabogados)
    {
        $menu = new Abogados();
 
        //se verifica si se ha enviado el formulario (submit)
        if (Input::hasPost('Abogados')) {
 
            if ($menu->update(Input::post('Abogados'))) {
                 Flash::valid('Operación exitosa');
                //enrutando por defecto al index del controller
                return Redirect::to();
            }
            Flash::error('Falló Operación');
            return;
        }

        //Aplicando la autocarga de objeto, para comenzar la edición
        $this->Abogados = $menu->find_by_IDabogados((int) $IDabogados);
 
    }

    public function eliminar($IDabogados)
    {
        if ((new Abogados)->delete((int) $IDabogados)) {
                Flash::valid('Operación exitosa');
        } else {
                Flash::error('Falló Operación');
        }

        //enrutando por defecto al index del controller
        return Redirect::to();
    }


    public function ver($IDabogados)
    {

        $see = new Abogados();
        $this->see = $see->find_by_IDabogados((int) $IDabogados);
    
    }

    public function listar($page = 1){
    
        $this->lista = (new Abogados)->getdatos($page);    
  }

}


