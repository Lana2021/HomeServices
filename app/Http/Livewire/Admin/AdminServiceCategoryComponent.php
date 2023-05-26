<?php

namespace App\Http\Livewire\Admin;

use App\Models\ServiceCategory;
use Livewire\Component;
use Livewire\WithPagination;

class AdminServiceCategoryComponent extends Component
{
    use WithPagination;

    public function dispatchEvent()
    {
        $this->dispatchBrowserEvent('event-notification', [
            'eventName' => 'Sample Event',
            'eventMessage' => 'You have a sample event notification!',
        ]);
    }

    public function deleteServiceCategory($id)
    {
        $scategory = ServiceCategory::find($id);
        if ($scategory->image) {
            unlink('images/categories' . '/' . $scategory->image);
        }
        $scategory->delete();
        session()->flash('message', 'Service Category has been deleted successfully!');

        $this->dispatchBrowserEvent('event-notification', [
            'eventName' => 'Success',
            'eventMessage' => 'You have successfully deleted service category!',
        ]);
    }
    public function render()
    {
        $scategories = ServiceCategory::paginate(10);
        return view('livewire.admin.admin-service-category-component', ['scategories' => $scategories])->layout('layouts.base');
    }
}
