<?php

// app/Http/Requests/StoreBookingRequest.php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Must be an active member to book
        return $this->user()->role === 'member' && 
               $this->user()->membership_expires_at > now();
    }

    public function rules(): array
    {
        return [
            'class_schedule_id' => [
                'required',
                'exists:class_schedules,id',
            ]
        ];
    }
    
    public function messages(): array
    {
        return [
            'class_schedule_id.exists' => 'The selected class schedule does not exist.'
        ];
    }
}