@extends('layouts.app')

<style>
    .buttonAdmin{
        width: 100%;
        height: 120px;
        background-color: #000;
        color: #fff;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        text-align: center;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: background-color 0.3s ease, transform 0.3s ease;
        cursor: pointer;
        font-family: Arial, Helvetica, sans-serif;
        margin-bottom: 20px;
    }

    .buttonAdmin:hover{
        transform: scale(1.05);
    }

    .buttonAdmin.active{
        transform: scale(1.05);
    }

    .fasIcon{
        font-size: 36px;
    }

    .accordion-body{
        margin-top: 20px;
        padding: 20px;
        background-color: #f7f7f7;
        border: 1px solid #ddd;
        border-radius: 10px;
    }

    .section{
        padding: 20px;
        border-bottom: 1px solid #ddd;
    }
</style>

<script>
    function activateButton(button){
        const buttons = document.querySelectorAll('.buttonAdmin');
        buttons.forEach((btn)=> {
            btn.classList.remove('active');
        });
        button.classList.add('active');
    }
</script>

@section('content')
<div class="container mt-3">
    <div class="leyenda">
        ¿Qué quieres registrar?
    </div>
    <br>
    <div class="accordion" id="accordionExample">
        <div class="row justify-content-center">
            <div class="col-md-3">
                <a href="{{url('/inventarioComputo')}}" class="buttonAdmin">
                    <i class="fas fa-desktop fasIcon"></i>
                    <div>Computó</div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="{{url('/inventarioRedes')}}" class="buttonAdmin">
                    <i class="fas fa-network-wired fasIcon"></i>
                    <div>Redes</div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="" class="buttonAdmin">
                    <i class="fas fa-mouse fasIcon"></i>
                    <div>Misceláneo</div>
                </a>
            </div>
            <div class="col-md-3">
                <a href="" class="buttonAdmin">
                    <i class="fas fa-phone-volume fasIcon"></i>
                    <div>Telefonía</div>
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
