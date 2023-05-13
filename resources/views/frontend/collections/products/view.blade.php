@extends('layouts.app')

@section('title' )
{{$product->meta_title}}
@endsection

@section('mete_keyword' )
{{$product->mete_keyword}}
@endsection

@section('meta_description' )
{{$product->meta_description}}
@endsection

@section('content')

<div>
    <livewire:frontend.products.view :category="$category" :product="$product"/>
</div>
    
    


@endsection