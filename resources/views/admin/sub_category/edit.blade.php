@extends('layouts.admin.app')
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Category</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.sub_category.index') }}">Back</a></li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>
        <section class="content">
            <div class="container-fluid">
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Category Details</h3>
                    </div>
                    <form action="{{ route('admin.sub_category.update', $category->id) }}" method="POST"
                        enctype="multipart/form-data" id="add-category">
                        @csrf
                        @method('PATCH')
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group category-select">
                                        <label>Choose Category</label>
                                        <select class="form-control categories select2" id="categories" name="category_id">
                                            <option value="" disabled>Select Category</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}"
                                                    {{ $cat->id == $category->category_id ? 'selected' : '' }}>
                                                    {{ $cat['name_' . app()->getLocale()] }}
                                                </option>
                                            @endforeach
                                        </select>
                                        {!! $errors->first('category_id', '<p class="help-block">:message</p>') !!}
                                    </div>
                                </div>
                                {{-- <div class="col-md-6">
                                    <div class="form-check" style="display: flex;align-items: center;height: 100%;">
                                        <input class="form-check-input set-as-parent" type="checkbox" value="1"
                                            name="is_parent" id="defaultCheck1"
                                            {{ $category->category_id == null ? 'checked' : '' }}>
                                        <label class="form-check-label" for="defaultCheck1">
                                            Set as Parent Category
                                        </label>
                                    </div>
                                </div> --}}
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputArabicName">Arabic Name</label>
                                        <input type="text" class="form-control" id="exampleInputArabicName"
                                            placeholder="Enter Arabic Name" name="name_ar" value="{{ $category->name_ar }}">
                                        @error('name_ar')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="exampleInputEnglishName">English Name</label>
                                        <input type="text" class="form-control" id="exampleInputEnglishName"
                                            placeholder="Enter English Name" name="name_en"
                                            value="{{ $category->name_en }}">
                                        @error('name_en')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputArabicDescription">Arabic Description</label>
                                        <textarea class="form-control" id="exampleInputArabicDescription" placeholder="Enter Arabic Description"
                                            name="description_ar">{{ $category->description_ar }}</textarea>
                                        @error('description_ar')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputEnglishDescription">English Description</label>
                                        <textarea class="form-control" id="exampleInputEnglishDescription" placeholder="Enter English Description"
                                            name="description_en">{{ $category->description_en }}</textarea>
                                        @error('description_en')
                                            <div class="help-block">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            {{-- <div class="row">
                            <div class="col-xs-12">
                                <div class="pl-3 card-title mb-2">
                                    <b>Dough</b>
                                </div>
                                <div class="card-body">
                                    @foreach ($doughTypes->groupBy('dough_type_id') as $doughGroup)
                                        <div class="mb-3">
                                            <div class="form-check">
                                                <input class="form-check-input" name="dough_type{{$loop->index > 0 ? '_2' : ''}}_id" type="checkbox"
                                                    value="{{ $doughGroup->first()->dough_type_id }}"
                                                    id="flexCheckDefault{{ $doughGroup->first()->dough_type_id }}" @if ($category->dough_type_id === $doughGroup->first()->dough_type_id) checked @endif>
                                                <label class="form-check-label"
                                                    for="flexCheckDefault{{ $doughGroup->first()->dough_type_id }}">
                                                    ({{ $doughGroup->first()->name_en }} -
                                                    {{ $doughGroup->first()->name_ar }},
                                                    {{ $doughGroup->last()->name_en }} -
                                                    {{ $doughGroup->last()->name_ar }})
                                                </label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div> --}}

                            {{-- <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="dough_type_id">Dough Type</label>
                                    <select class="form-control" name="dough_type_id">
                                        @if ($category->dough_type_id == 0)
                                        <option selected value=0>مشروبات</option>
                                        <option value=1>غير المعجنات</option>
                                        <option value=2>معجنات</option>
                                        @elseif($category->dough_type_id == 1)
                                        <option value=0>مشروبات</option>
                                        <option selected value=1>غير معجنات</option>
                                        <option value=2>معجنات</option>
                                        @else
                                        <option value=0>مشروبات</option>
                                        <option value=1>غير معجنات</option>
                                        <option selected value=2>معجنات</option>
                                        @endif

                                    </select>
                                    @error('dough_type_id')
                                    <div class="help-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div> --}}
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Image</label>
                                        <img src="{{ $category->image }}" class="mg-fluid img-thumbnail"
                                            style="max-width: 75px"></td>
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile"
                                                name="image">
                                            @error('image')
                                                <div class="help-block">{{ $message }}</div>
                                            @enderror
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="details">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputreturn-policy-arabic">Arabic Return Policy</label>
                                            <textarea class="form-control" id="exampleInputreturn-policy-arabic" placeholder="Enter English Description"
                                                name="return_policy_ar">{{ $category->return_policy_ar }}</textarea>
                                            @error('return_policy_ar')
                                                <div class="help-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleInputreturn-policy-english">english Return Policy</label>
                                            <textarea class="form-control" id="exampleInputreturn-policy-english" placeholder="Enter English Description"
                                                name="return_policy_en">{{ $category->return_policy_en }}</textarea>
                                            @error('return_policy_en')
                                                <div class="help-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="row" x-data="{
                                    data: JSON.parse('{{ json_encode($category->shipping_details_ar) }}'),
                                    data_en: JSON.parse('{{ json_encode($category->shipping_details_en) }}'),
                                    shipping: [],
                                    shipping_en: [],
                                    addOne: function() {
                                        this.shipping.push({txt: ''});
                                    },
                                    remove: function(txt) {
                                        var inx = this.shipping.findIndex(x => x.txt == txt);
                                        this.shipping.splice(inx, 1);
                                    },
                                    addOneEn: function() {
                                        this.shipping_en.push({txt: ''});
                                    },
                                    removeEn: function(txt) {
                                        var inx = this.shipping_en.findIndex(x => x.txt == txt);
                                        this.shipping_en.splice(inx, 1);
                                    },
                                }" x-init="() => {
                                    for (var i = 0; i < data.length; i++) {
                                        shipping.push({txt: data[i]});
                                        shipping_en.push({txt: data[i]});
                                    }
                                }">
                                    <div class="col-md-6" >
                                        <label for="exampleInputArabicName row" style="width: 100%">
                                            <div class="col-sm-6" style="display: inline">
                                                Arabic Shipping Details
                                            </div>
                                            <div class="col-sm-5 " style="text-align: right;display: inline">
                                                <button class="btn btn-success btn-sm"
                                                    x-on:click.prevent="addOne();addOneEn()">+</button>
                                            </div>
                                        </label>

                                        <template x-for="sh in shipping" :key="Math.random()">
                                            <div class="form-group row">
                                                <input type="text" class="form-control col-md-10"
                                                    id="exampleInputArabicName"
                                                    placeholder="Enter Arabic Shipping Details"
                                                    name="shipping_details_ar[]" x-model="sh.txt" />
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        x-on:click.prevent="remove(sh.txt)">x</button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="exampleInputEnglishName row" style="width: 100%">
                                            <div class="col-sm-6" style="display: inline">
                                                English Shipping Details
                                            </div>
                                        </label>

                                        <template x-for="sh in shipping_en" :key="Math.random()">
                                            <div class="form-group row">
                                                <input type="text" class="form-control col-md-10"
                                                    id="exampleInputEnglishName"
                                                    placeholder="Enter English Shipping Details"
                                                    name="shipping_details_en[]" x-model="sh.txt" />
                                                <div class="col-md-2">
                                                    <button type="button" class="btn btn-sm btn-danger"
                                                        x-on:click.prevent="removeEn(sh.txt)">x</button>
                                                </div>
                                            </div>
                                        </template>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary float-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('js')
    <script>
        window.onbeforeunload = function() {
            return 'Are you sure? Your work will be lost. ';
        };

        $(document).ready(function() {

            $('.custom-file-input').on('change', function() {

                //get the file name
                var fileName = $(this).val();

                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
            })

            $('input').change(function(e) {
                // Warning
                $(window).on('beforeunload', function() {
                    return "Are you sure you want to navigate away from this page?";
                });

                // Form Submit
                $(document).on("submit", "form", function(event) {
                    // disable unload warning
                    $(window).off('beforeunload');
                });
            });

            // $('.set-as-parent').change(function(e) {
            //     var checked = $(this).is(":checked");
            //     if (checked) {
            //         $('.category-select .select2.select2-container, #details').css('display', 'none');
            //     } else {
            //         $('.category-select .select2.select2-container, #details').css('display', 'block');
            //     }
            // });

            // setTimeout(() => {
            //     console.log($('.set-as-parent').is(":checked"));
            //     if ($('.set-as-parent').is(":checked")) {
            //         $('.category-select .select2.select2-container, #details').css('display', 'none');
            //     } else {
            //         $('.category-select .select2.select2-container, #details').css('display', 'block');
            //     }
            // }, 250);
        });
    </script>
@endpush
