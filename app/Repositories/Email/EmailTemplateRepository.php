<?php

namespace App\Repositories\Email;

use App\Repositories\Email\EmailTemplateRepositoryInterface;
use Illuminate\Pipeline\Pipeline;
use App\EmailTemplate;

class EmailTemplateRepository implements EmailTemplateRepositoryInterface
{
    /**
     * @return
     */
    public function getModel(){
        return EmailTemplate::class;

    }

    public function store($attributes){
        unset($attributes['files']);
        return EmailTemplate::create($attributes);
    }

    public function getAllWithPagination(){
        return EmailTemplate::paginate(10);
    }

    public function getAllEmailTemplate(){
        return EmailTemplate::all();
    }

    public function findById($id){
        return  EmailTemplate::find($id);
    }

    public function update($request, $id){
        unset($request['files']);
        $emailTemplates = EmailTemplate::find($id)->update($request->except([
            '_token','_method'

        ]));
        return $emailTemplates;
    }

    public function getFilterWithPaginate(){
        $items = (in_array(request()->items, [10, 25, 50])) ? request()->items : 10;
        return EmailTemplate::paginate($items);
    }


    public function delete($id, $forceDelete = false){
        if($forceDelete){
            return $this->findById($id)->forceDelete();
        }else{
            return $this->findById($id)->delete();
        }
    }

    public function shortCodeArr()
    {
        return $shortCodeArr = [
            ["key"=>"{{username}}","value"=>"Username"],
            ["key"=>"{{email}}","value"=>"Email"],
            ["key"=>"{{name}}","value"=>"Name"]
        ];
    }
}
