<?php

namespace App\Helpers;

use App\UserLog;
use Carbon\Carbon;
use App\User;

class LogHelper
{
	public function storeLogCustomMessage($msg, $type)
	{
		$name = auth()->user()->name ?? "System";
		$item 	= [
			'user_id' 		=> auth()->user()->id ?? "1",
			'action' 		=> $this->typeFormatted($type),
			'message' 		=> $msg
		];

		UserLog::create($item);
		return true;
	}

	public function storeLogMsg($msg, $type)
	{
		$name = auth()->user()->name ?? "System";
		$item 	= [
			'user_id' 		=> auth()->user()->id ?? "1",
			'action' 		=> $this->typeFormatted($type),
			'message' 		=> $name . " melakukan " . $msg
		];

		UserLog::create($item);
		return true;
	}

	public function storeLogMsgWebApi($userid, $msg, $type)
	{
		$name = User::find($userid)->name ?? "System";
		$item 	= [
			'user_id' 		=> $userid ?? "1",
			'action' 		=> $this->typeFormatted($type),
			'message' 		=> $name . " melakukan " . $msg
		];

		UserLog::create($item);
		return true;
	}

	public function storeLog($type, $nomor, $menu)
	{
		$item 	= [
			'user_id' 		=> auth()->user()->id ?? "1",
			'menu' 			=> $menu,
			'action' 		=> $this->typeFormatted($type),
			'message' 		=> $this->makeLogMessage(auth()->user()->name ?? "System", $type, $nomor, $menu),
		];

		UserLog::create($item);
		return true;
	}

	public function storeLogWebapi($user, $name, $type, $nomor, $menu)
	{
		$item 	= [
			'user_id' 		=> $user,
			'menu' 			=> $menu,
			'action' 		=> $this->typeFormatted($type),
			'message' 		=> $this->makeLogMessage($name, $type, $nomor, $menu),
		];

		UserLog::create($item);
		return true;
	}

	public function makeLogMessage($name, $type, $nomor, $menu)
	{
		$message 		= '<p>User <b>' . $name . '</b> melakukan ' . $this->typeFormatted($type);

		$message 		.= $this->textMenuDanNomor($menu, $nomor);
		// $message 		.= $this->textTanggal();

		return $message;
	}

	public function typeFormatted($type)
	{
		$str 	= $type;
		switch ($type) {
			case 'add':
				$str 		= 'Penambahan';
				break;
			case 'edit':
				$str 		= 'Perubahan';
				break;
			case 'update':
				$str 		= 'Perubahan';
				break;
			case 'delete':
				$str 		= 'Penghapusan';
				break;
			case 'confirm':
				$str 		= 'Konfirmasi';
				break;
			case 'unconfirm':
				$str 		= 'Batal Konfirmasi';
				break;
			case 'closed':
				$str 		= 'Selesai';
				break;
			case 'unclosed':
				$str 		= 'Batal Selesai';
				break;
			case 'rejected':
				$str 		= 'Pembatalan';
				break;
			case 'unrejected':
				$str 		= 'Batal Pembatalan';
				break;
		}

		return $str;
	}

	public function textTanggal()
	{
		return ' pada tanggal <b>' . Carbon::now()->format('d F Y H:i:s') . '</b> </p>';
	}

	public function textMenuDanNomor($menu, $nomor)
	{
		return ' data di menu <b>' . ucwords($menu) . '</b> dan id/nomor <b>' . $nomor . '</b>';
	}
}
