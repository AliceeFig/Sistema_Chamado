<?php


namespace App\Enums;

enum PermissionEnum : string 
{
    case CRIAR_USUARIO = 'create-usuario';
    case EDITAR_USUARIO = 'edit-usuario';
    case VISUALIZAR_USUARIO = 'view-usuario';
    case DELETAR_USARIO = 'delete-usuario';
    case CRIAR_CHAMADA = 'create-chamada';
    case EDITAR_CHAMADA = 'edit-chamada';
    case VISUALIZAR_CHAMADA = 'view-chamada';
    case DELETAR_CHAMADA = 'delete-chamada';
}