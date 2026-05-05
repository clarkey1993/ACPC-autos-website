<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'make' => ['required', 'string', 'max:255'],
            'model' => ['required', 'string', 'max:255'],
            'year' => ['required', 'integer', 'digits:4', 'min:1900', 'max:' . (date('Y') + 1)],
            'price' => ['required', 'integer', 'min:0'],
            'mileage' => ['nullable', 'integer', 'min:0'],
            'location' => ['nullable', 'string', 'max:120'],
            'fuel_type' => ['nullable', 'in:Petrol,Diesel,Hybrid'],
            'transmission' => ['nullable', 'in:Manual,Automatic'],
            'colour' => ['nullable', 'string', 'max:50'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:available,reserved,sold,arriving_soon,just_arrived'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'featured_image' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
            'gallery_images' => ['nullable', 'array'],
            'gallery_images.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Title is required.',
            'title.max' => 'The title must not exceed 255 characters.',
            'make.required' => 'Make is required.',
            'make.max' => 'The make must not exceed 255 characters.',
            'model.required' => 'Model is required.',
            'model.max' => 'The model must not exceed 255 characters.',
            'year.required' => 'Year is required.',
            'year.integer' => 'Year must be a number.',
            'year.digits' => 'The year must be 4 digits.',
            'year.min' => 'The year must be at least 1900.',
            'year.max' => 'The year cannot be more than next year.',
            'price.required' => 'Price is required.',
            'price.integer' => 'Price must be a number.',
            'price.min' => 'The price cannot be negative.',
            'mileage.integer' => 'Mileage must be a number.',
            'mileage.min' => 'Mileage cannot be negative.',
            'fuel_type.in' => 'Fuel type must be Petrol, Diesel, or Hybrid.',
            'transmission.in' => 'Transmission must be Manual or Automatic.',
            'colour.max' => 'Colour must not exceed 50 characters.',
            'status.required' => 'Status is required.',
            'status.in' => 'Status must be available, reserved, sold, arriving soon, or just arrived.',
            'sort_order.integer' => 'Display order must be a number.',
            'sort_order.min' => 'Display order cannot be negative.',
            'featured_image.image' => 'Featured image must be an image file.',
            'featured_image.mimes' => 'Featured image must be a JPG, JPEG, PNG, or WEBP file.',
            'featured_image.max' => 'Featured image must be 4MB or smaller.',
            'gallery_images.array' => 'Gallery images must be sent as a list of files.',
            'gallery_images.*.image' => 'Each gallery image must be an image file.',
            'gallery_images.*.mimes' => 'Each gallery image must be a JPG, JPEG, PNG, or WEBP file.',
            'gallery_images.*.max' => 'Each gallery image must be 4MB or smaller.',
        ];
    }
}
