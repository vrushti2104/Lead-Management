<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\StoreLeadRequest;
use Illuminate\Validation\Rule;

class UpdateLeadRequest extends StoreLeadRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
       $request = parent::rules();

       $leadId = $this->route('lead')?->id; 

        foreach($request as $key => $rule){
            if (is_array($rule)) {
                $request[$key] = array_map(function ($item) {
                    return preg_replace('/^required$/', 'sometimes', $item);
                }, $rule);
            } else {
                $request[$key] = preg_replace('/^required\|/', 'sometimes|', $rule);
            }

            if($key == 'email')
            {
              $rule = [ 'sometimes','email',Rule::unique('leads','email')->ignore($leadId)];
              $request[$key] = $rule;
            }

            if($key == 'phone')
            {
              $rule = [ 'sometimes','string','max:13',Rule::unique('leads','phone')->ignore($leadId)];
              $request[$key] = $rule;
            }
        
        }
        return $request;
    }
}
