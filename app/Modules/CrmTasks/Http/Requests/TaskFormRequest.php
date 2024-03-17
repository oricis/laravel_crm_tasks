<?php

namespace App\Modules\CrmTasks\Http\Requests;

use App\Modules\CrmTasks\Repositories\Data\Data;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class TaskFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {
        $this->merge([
            'start_at' => (new Carbon($this->start_at))
                ->format(Data::DATE_TIME_FORMAT),
            'expired_at' => (new Carbon($this->expired_at))
                ->format(Data::DATE_TIME_FORMAT),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'      => 'required|string|max:100',
            'description' => 'nullable|string|max:255',
            'task_group_id' => 'integer|min:1|exists:task_groups,id',

            // Set when the task starts and ends
            'start_time_id' => 'integer|min:1|exists:start_times,id',
            'expiration_time_id' => 'integer|min:1|exists:expiration_times,id',

            // Set time to maintain active the task assignation
            'start_at'   => 'required|string|date_format:' . Data::DATE_TIME_FORMAT,
            'expired_at' => 'required|string|date_format:' . Data::DATE_TIME_FORMAT,
        ];
    }


}
