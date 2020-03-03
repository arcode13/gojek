<?php

// https://github.com/arcode13/gojek

// Header
$secret = '83415d06-ec4e-11e6-a41b-6c40088ab51e';
$headers = array();
$headers[] = 'Content-Type: application/json';
$headers[] = 'X-AppVersion: 3.27.0';
$headers[] = "X-Uniqueid: ac94e5d0e7f3f".rand(111,999);
$headers[] = 'X-Location: -6.405821,106.064193';

// Menu Tools
echo "\n";
echo "==========================================\n";
echo "         Tools GOJEK Versi 0.1\n";
echo "        Update Tools & BUG Fixed\n";
echo "     Thanks To : SGB Team & ArCode\n";
echo "==========================================\n";
echo "\n";
echo "Silahkan Pilih Salah Satu Tools Dibawah Ini :\n";
echo "1. Redeem Kode Voucher Manual\n";
echo "2. Redeem Kode Voucher Terkini\n";
echo "3. Saldo GoPay Random (5-10 Perak)\n";
echo "4. Ganti Nomor\n";
echo "5. Daftar Akun Baru\n";
echo "6. Cek Akun\n";
echo "7. Mendapatkan Token Akun\n";
echo "8. Daftar Voucher Yang Didapatkan\n";
echo "9. Redeem Kode Referral [NEW]\n";
echo "[+] Masukin Salah Satu Nomor Tools Diatas Nya Disini: ";
$type1 = trim(fgets(STDIN));
if ($type1 == 1) {
// Redeem Kode Voucher Manual
echo "\n";
echo "===============================================\n";
echo "     Tools Redeem Kode Voucher Manual GOJEK\n";
echo "        By : Muh. Syahrul Minanul Aziz\n";
echo "===============================================\n";
echo "\n";
echo "Silahkan Pilih Salah Satu Dibawah Ini :\n";
echo "1. Masuk (Akun Lama)\n";
echo "2. Daftar (Akun Baru)\n";
echo "[+] Masukin Salah Satu Nomor Diatas Nya Disini : ";
$redeem1 = trim(fgets(STDIN));
if ($redeem1 == "1")
	{
		echo "\n";
		echo "====================================================\n";
		echo "    Tools MASUK AKUN + REDEEM KODE VOUCHER GOJEK\n";
		echo "           By : Muh. Syahrul Minanul Aziz\n";
		echo "====================================================\n";
		echo "\n";
		echo "----------------------------------------------------\n";
		echo "| INFO : 62 Untuk Nomor INDO Dan 1 Untuk Nomor US  |\n";
		echo "| Contoh Nya Begini : - Nomor INDO 6281234567890   |\n";
		echo "|                     - Nomor US 13377352197       |\n";
		echo "----------------------------------------------------\n";
		nomor1_ulang:
		echo "[+] Masukin Nomor GOJEK Kamu Disini : ";
		$number = trim(fgets(STDIN));
		$login = curl('https://api.gojekapi.com/v3/customers/login_with_phone', '{"phone":"+' . $number . '"}', $headers);
		$logins = json_decode($login[0]);
		if($logins->success == true) {
		    otp1_ulang:
			echo "[+] Masukin Kode OTP Kamu Disini : ";
			$otp = trim(fgets(STDIN));
			$data1 = '{"scopes":"gojek:customer:transaction gojek:customer:readonly","grant_type":"password","login_token":"' . $logins->data->login_token . '","otp":"' . $otp . '","client_id":"gojek:cons:android","client_secret":"' . $secret . '"}';
			$verif = curl('https://api.gojekapi.com/v3/customers/token', $data1, $headers);
			$verifs = json_decode($verif[0]);
			if($verifs->success == true) {
				$token = $verifs->data->access_token;
				$headers[] = 'Authorization: Bearer '.$token;
				$live = "token-akun.txt";
                $fopen1 = fopen($live, "a+");
                $fwrite1 = fwrite($fopen1, "Token Kamu : ".$token."\nNomor GoJek Kamu : ".$number."\nKeterangan : 1. Tools MASUK AKUN + REEDEM KODE VOUCHER GOJEK\n\n");
				fclose($fopen1);
				echo "\n";
				echo "Token Kamu : ".$token."\n";
				echo "Token Berhasil Disimpan Di File ".$live." \n";
				echo "\n";
				echo "[+] Masukin Kode Voucher GOJEK Nya Disini : ";
				$kode = trim(fgets(STDIN));
				echo "\n";
				$data3 = '{"promo_code":"'.$kode.'"}';
				$claim = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data3, $headers);
				$claims = json_decode($claim[0]);
				echo "Proses Redeem Kode Voucher!\n";
				echo "Redeem Kode Voucher : $kode\n";
				if ($claims->success == true) {
					echo "Berhasil Mendapatkan Voucher, ~ Toss Dulu Dong!\n";
                    echo "Proses Redeem Kode Voucher Selesai!\n";
                    echo "\n";
					} else {
                        echo "Gagal Mendapatkan Voucher!\n";
                        echo "\n";
					}
			} else {
				echo "\n";
				echo "Yah Kode OTP Salah, Coba Kamu Ulangi Lagi Deh!\n";
				echo "\n";
				goto otp1_ulang;
			}
		} else {
			echo "\n";
			echo "Yah Gagal Mengirim Kode OTP, Gunakan Nomor Yang Sudah Terdaftar Di GOJEK Yah!\n";
			echo "\n";
			goto nomor1_ulang;
		}
	} else if ($redeem1 == "2")
	{
		echo "\n";
		echo "========================================================\n";
		echo "   Tools DAFTAR AKUN BARU + REDEEM KODE VOUCHER GOJEK\n";
		echo "             By : Muh. Syahrul Minanul Aziz\n";
		echo "========================================================\n";
		echo "\n";
		echo "--------------------------------------------------------\n";
		echo "| INFO : 62 Untuk Nomor INDO Dan 1 Untuk Nomor US      |\n";
		echo "| Contoh Nya Begini : - Nomor INDO 6281234567890       |\n";
		echo "|                     - Nomor US 13377352197           |\n";
		echo "| Pastikan Nomor Kamu Belum Terdaftar Di GOJEK Yah!    |\n";
		echo "--------------------------------------------------------\n";
		nomor2_ulang:
		echo "[+] Masukin Nomor Kamu Disini : ";
		$number = trim(fgets(STDIN));
		$nama = nama();
		$email = strtolower(str_replace(" ", "", $nama) . mt_rand(100,999) . "@gmail.com");
		$data1 = '{"name":"' . $nama . '","email":"' . $email . '","phone":"+' . $number . '","signed_up_country":"ID"}';
		$reg = curl('https://api.gojekapi.com/v5/customers', $data1, $headers);
		$regs = json_decode($reg[0]);
		if($regs->success == true) {
			otp2_ulang:
			echo "[+] Masukin Kode OTP Kamu Disini : ";
			$otp = trim(fgets(STDIN));
			$data2 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $regs->data->otp_token . '"},"client_secret":"' . $secret . '"}';
			$verif = curl('https://api.gojekapi.com/v5/customers/phone/verify', $data2, $headers);
			$verifs = json_decode($verif[0]);
			if($verifs->success == true) {
				$token = $verifs->data->access_token;
				$headers[] = 'Authorization: Bearer '.$token;
				$live = "token-akun.txt";
                $fopen1 = fopen($live, "a+");
                $fwrite1 = fwrite($fopen1, "Token Kamu : ".$token."\nNomor GoJek Kamu : ".$number."\nKeterangan : 1. Tools DAFTAR AKUN BARU + REEDEM KODE VOUCHER GOJEK\n");
				fclose($fopen1);
				echo "\n";
				echo "Token Kamu : ".$token."\n";
				echo "Token Berhasil Disimpan Di File ".$live." \n";
				echo "\n";
				echo "[+] Masukin Kode Voucher GOJEK Nya Disini : ";
				$kode = trim(fgets(STDIN));
				echo "\n";
				$data3 = '{"promo_code":"'.$kode.'"}';
				$claim = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data3, $headers);
				$claims = json_decode($claim[0]);
				echo "Proses Redeem Kode Voucher!\n";
				echo "Redeem Kode Voucher : $kode\n";
				if ($claims->success == true) {
					echo "Berhasil Mendapatkan Voucher, ~ Toss Dulu Dong!\n";
                    echo "Proses Redeem Kode Voucher Selesai!\n";
                    echo "\n";
					} else {
                        echo "Gagal Mendapatkan Voucher!!\n";
                        echo "\n";
					}
			} else {
				echo "\n";
				echo "Yah Kode OTP Salah, Coba Kamu Ulangi Lagi Deh!\n";
				echo "\n";
				goto otp2_ulang;
			}
		} else {
			echo "\n";
			echo "Yah Gagal Mengirim Kode OTP, Gunakan Nomor Yang Belum Terdaftar Di GOJEK Yah!\n";
			echo "\n";
			goto nomor2_ulang;
		}
	}

} else if ($type1 == 2) {
// Tools Redeem Kode Voucher Terkini
echo "\n";
echo "===============================================\n";
echo "    Tools Redeem Kode Voucher GOJEK x GOJEK\n";
echo "        By : Muh. Syahrul Minanul Aziz\n";
echo "===============================================\n";
echo "\n";
echo "Silahkan Pilih Salah Satu Dibawah Ini :\n";
echo "1. Masuk (Akun Lama)\n";
echo "2. Daftar (Akun Baru)\n";
echo "[+] Masukin Salah Satu Nomor Diatas Nya Disini : ";
$tools = trim(fgets(STDIN));
if($tools == "1")
	{
		echo "\n";
		echo "====================================================\n";
		echo "    Tools MASUK AKUN + REDEEM KODE VOUCHER GOJEK\n";
		echo "           By : Muh. Syahrul Minanul Aziz\n";
		echo "====================================================\n";
		echo "\n";
		echo "----------------------------------------------------\n";
		echo "| INFO : 62 Untuk Nomor INDO Dan 1 Untuk Nomor US  |\n";
		echo "| Contoh Nya Begini : - Nomor INDO 6281234567890   |\n";
		echo "|                     - Nomor US 13377352197       |\n";
		echo "----------------------------------------------------\n";
		nomor3_ulang:
		echo "[+] Masukin Nomor GOJEK Kamu Disini : ";
		$number = trim(fgets(STDIN));
		$login = curl('https://api.gojekapi.com/v3/customers/login_with_phone', '{"phone":"+' . $number . '"}', $headers);
		$logins = json_decode($login[0]);
		if($logins->success == true) {
		    otp3_ulang:
			echo "[+] Masukin Kode OTP Kamu Disini : ";
			$otp = trim(fgets(STDIN));
			$data1 = '{"scopes":"gojek:customer:transaction gojek:customer:readonly","grant_type":"password","login_token":"' . $logins->data->login_token . '","otp":"' . $otp . '","client_id":"gojek:cons:android","client_secret":"' . $secret . '"}';
			$verif = curl('https://api.gojekapi.com/v3/customers/token', $data1, $headers);
			$verifs = json_decode($verif[0]);
			if($verifs->success == true) {
				$token = $verifs->data->access_token;
				$headers[] = 'Authorization: Bearer '.$token;
				$live = "token-akun.txt";
                $fopen1 = fopen($live, "a+");
                $fwrite1 = fwrite($fopen1, "Token Kamu : ".$token."\nNomor GoJek Kamu : ".$number."\nKeterangan : 2. Tools MASUK AKUN + REEDEM KODE VOUCHER GOJEK [GOFOODBOBA07]\n\n");
				fclose($fopen1);
				echo "\n";
				echo "Token Kamu : ".$token."\n";
				echo "Token Berhasil Disimpan Di File : ".$live." \n";
				echo "\n";
				echo "Proses Redeem Kode Voucher\n";
                echo "Redeem Kode Voucher : GOFOODBOBA07\n";
				$data3 = '{"promo_code":"GOFOODBOBA07"}';
				$claim = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data3, $headers);
				$claims = json_decode($claim[0]);
				if ($claims->success == true) {
					echo "Berhasil Mendapatkan Voucher, ~ Toss Dulu Dong!\n";
					echo "Proses Redeem Kode Voucher Selesai!\n";
                echo "\n";
				sleep(10);
				voucher1_ulang:
				echo "Proses Redeem Kode Voucher\n";
                echo "Redeem Kode Voucher : COBAINGOJEK\n";
                $data4 = '{"promo_code":"COBAINGOJEK"}';
				$claim2 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data4, $headers);
				$claims2 = json_decode($claim2[0]);
				if ($claims2->success == true) {
					echo "Berhasil Mendapatkan Voucher, ~ Toss Dulu Dong!\n";
				    echo "Proses Redeem Kode Voucher Selesai!\n";
				sleep(10);
				voucher2_ulang:
				echo "Proses Redeem Kode Voucher\n";
                echo "Redeem Kode Voucher : AYOCOBAGOJEK\n";
                $data5 = '{"promo_code":"AYOCOBAGOJEK"}';
				$claim3 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data5, $headers);
				$claims3 = json_decode($claim3[0]);
				if ($claims3->success == true) {
					echo "Berhasil Mendapatkan Voucher, ~ Toss Dulu Dong!\n";
					echo "Proses Redeem Kode Voucher Selesai!\n";
					echo "\n";
			} else {
				echo "Gagal Mendapatkan Voucher!\n";
				echo "\n";
			}
		} else {
			echo "Gagal Mendapatkan Voucher!\n";
			echo "Mencoba Kembali Redeem Voucher Lain!\n";
			echo "\n";
			sleep(10);
			goto voucher2_ulang;
		}
	} else {
		echo "Gagal Mendapatkan Voucher!\n";
		echo "Mencoba Kembali Redeem Voucher Lain!\n";
		echo "\n";
		sleep(10);
		goto voucher1_ulang;
	}
} else {
	echo "\n";
	echo "Yah Kode OTP Salah, Coba Kamu Ulangi Lagi Deh!\n";
	echo "\n";
	goto otp3_ulang;
}
} else {
	echo "\n";
	echo "Yah Gagal Mengirim Kode OTP, Gunakan Nomor Yang Sudah Terdaftar Di GOJEK Yah!\n";
	echo "\n";
	goto nomor3_ulang;
	
}
	} else if($tools == "2")
	{
		echo "\n";
		echo "========================================================\n";
		echo "   Tools DAFTAR AKUN BARU + REDEEM KODE VOUCHER GOJEK\n";
		echo "             By : Muh. Syahrul Minanul Aziz\n";
		echo "========================================================\n";
		echo "\n";
		echo "--------------------------------------------------------\n";
		echo "| INFO : 62 Untuk Nomor INDO Dan 1 Untuk Nomor US      |\n";
		echo "| Contoh Nya Begini : - Nomor INDO 6281234567890       |\n";
		echo "|                     - Nomor US 13377352197           |\n";
		echo "| Pastikan Nomor Kamu Belum Terdaftar Di GOJEK Yah!    |\n";
		echo "--------------------------------------------------------\n";
		nomor4_ulang:
		echo "[+] Masukin Nomor Kamu Disini : ";
		$number = trim(fgets(STDIN));
		$nama = nama();
		$email = strtolower(str_replace(" ", "", $nama) . mt_rand(100,999) . "@gmail.com");
		$data1 = '{"name":"' . $nama . '","email":"' . $email . '","phone":"+' . $number . '","signed_up_country":"ID"}';
		$reg = curl('https://api.gojekapi.com/v5/customers', $data1, $headers);
		$regs = json_decode($reg[0]);
		if($regs->success == true) {
		    otp4_ulang:
			echo "[+] Masukin Kode OTP Kamu Disini : ";
			$otp = trim(fgets(STDIN));
			$data2 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $regs->data->otp_token . '"},"client_secret":"' . $secret . '"}';
			$verif = curl('https://api.gojekapi.com/v5/customers/phone/verify', $data2, $headers);
			$verifs = json_decode($verif[0]);
			if($verifs->success == true) {
				$token = $verifs->data->access_token;
				$headers[] = 'Authorization: Bearer '.$token;
				$live = "token-akun.txt";
                $fopen1 = fopen($live, "a+");
                $fwrite1 = fwrite($fopen1, "Token Kamu : ".$token."\nNomor GoJek Kamu : ".$number."\nKeterangan : 2. Tools DAFTAR AKUN BARU + REEDEM KODE VOUCHER GOJEK [GOFOODBOBA07]\n\n");
				fclose($fopen1);
				echo "\n";
				echo "Token Kamu : ".$token."\n";
				echo "Token Berhasil Disimpan Di File : ".$live." \n";
				echo "\n";
				echo "Proses Redeem Kode Voucher\n";
                echo "Redeem Kode Voucher : GOFOODSANTAI19\n";
				$data3 = '{"promo_code":"GOFOODSANTAI19"}';
				$claim0 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data3, $headers);
				$claims0 = json_decode($claim0[0]);
				if ($claims0->success == true) {
					echo "Berhasil Mendapatkan Voucher, ~ Toss Dulu Dong!\n";
					echo "Proses Redeem Kode Voucher Selesai!\n";
                echo "\n";
				sleep(10);
				voucher3_ulang:
				echo "Proses Redeem Kode Voucher\n";
                echo "Redeem Kode Voucher : GOFOODSANTAI11\n";
				$data4 = '{"promo_code":"GOFOODSANTAI11"}';
				$claim1 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data4, $headers);
				$claims1 = json_decode($claim1[0]);
				if ($claims1->success == true) {
					echo "Berhasil Mendapatkan Voucher, ~ Toss Dulu Dong!\n";
					echo "Proses Redeem Kode Voucher Selesai!\n";
                echo "\n";
				sleep(10);
				voucher4_ulang:
				echo "Proses Redeem Kode Voucher\n";
                echo "Redeem Kode Voucher : GOFOODSANTAI08\n";
				$data5 = '{"promo_code":"GOFOODSANTAI08"}';
				$claim2 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data5, $headers);
				$claims2 = json_decode($claim2[0]);
				if ($claims2->success == true) {
					echo "Berhasil Mendapatkan Voucher, ~ Toss Dulu Dong!\n";
					echo "Proses Redeem Kode Voucher Selesai!\n";
                echo "\n";
				sleep(10);
				voucher5_ulang:
				echo "Proses Redeem Kode Voucher\n";
                echo "Redeem Kode Voucher : COBAINGOJEK\n";
                $data6 = '{"promo_code":"COBAINGOJEK"}';
				$claim3 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data6, $headers);
				$claims3 = json_decode($claim3[0]);
				if ($claims3->success == true) {
					echo "Berhasil Mendapatkan Voucher, ~ Toss Dulu Dong!\n";
					echo "Proses Redeem Kode Voucher Selesai!\n";
				echo "\n";
				sleep(10);
				voucher6_ulang:
				echo "Proses Redeem Kode Voucher\n";
                echo "Redeem Kode Voucher : AYOCOBAGOJEK\n";
                $data7 = '{"promo_code":"AYOCOBAGOJEK"}';
				$claim4 = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data7, $headers);
				$claims4 = json_decode($claim4[0]);
				if ($claims4->success == true) {
					echo "Berhasil Mendapatkan Voucher, ~ Toss Dulu Dong!\n";
					echo "Proses Redeem Kode Voucher Selesai!\n";
					echo "\n";
			} else {
				echo "Gagal Mendapatkan Voucher!\n";
				echo "\n";
			}
		} else {
			echo "Gagal Mendapatkan Voucher!\n";
			echo "Mencoba Kembali Redeem Voucher Lain!\n";
			echo "\n";
			sleep(10);
			goto voucher6_ulang;
		}
		} else {
			echo "Gagal Mendapatkan Voucher!\n";
			echo "Mencoba Kembali Redeem Voucher Lain!\n";
			echo "\n";
			sleep(10);
			goto voucher5_ulang;
		}
		} else {
			echo "Gagal Mendapatkan Voucher!\n";
			echo "Mencoba Kembali Redeem Voucher Lain!\n";
			echo "\n";
			sleep(10);
			goto voucher4_ulang;
		}
	} else {
		echo "Gagal Mendapatkan Voucher!\n";
		echo "Mencoba Kembali Redeem Voucher Lain!\n";
		echo "\n";
		sleep(10);
		goto voucher3_ulang;
	}
} else {
	echo "\n";
	echo "Yah Kode OTP Salah, Coba Kamu Ulangi Lagi Deh!\n";
	echo "\n";
	goto otp4_ulang;
}
} else {
	echo "\n";
	echo "Yah Gagal Mengirim Kode OTP, Gunakan Nomor Yang Sudah Terdaftar Di GOJEK Yah!\n";
	echo "\n";
	goto nomor4_ulang;
	
}
}

} else if ($type1 == 3) {
// Tools Transfer Saldo GoPay Random
	echo "\n";
	echo "=====================================================\n";
	echo "      Tools TRANSFER SALDO GOPAY RANDOM x GOJEK\n";
	echo "           By : Muh. Syahrul Minanul Aziz\n";
	echo "=====================================================\n";
	echo "\n";
	echo "-----------------------------------------------------\n";
	echo "| INFO : 62 Untuk Nomor INDO Dan 1 Untuk Nomor US   |\n";
	echo "| Contoh Nya Begini : - Nomor INDO 6281234567890    |\n";
	echo "|                     - Nomor US 13377352197        |\n";
	echo "| Pastikan Nomor Kamu Sudah Terdaftar Di GOJEK Yah! |\n";
	echo "-----------------------------------------------------\n";
	echo "[+] Masukin Nomor GOJEK Kamu Disini : ";
	$number = trim(fgets(STDIN));
			$secret = ''; // TOKEN AKUN
			$pin = ""; // PIN GOPAY
			$amount = rand(5,10);  //RANDOM NOMINAL
			$amountt = $amount;
			$amount = random_number(1);
			$headers = array();
			$header[] = 'Content-Type: application/json';
			$header[] = 'X-AppVersion: 3.40.0';
			$header[] = "X-Uniqueid: ac94e5d0e7f3f".rand(111,999);
			$header[] = 'X-Location: -6.405821,106.064193';
			$header[] ='Authorization: Bearer '.$secret;
			$header[] = 'pin:'.$pin.'';
			$getqrid = curl('https://api.gojekapi.com/wallet/qr-code?phone_number=%2B'.$number.'', null, $header);
			$jsqrid = json_decode($getqrid[0]);
			$qrid = $jsqrid->data->qr_id;
			$tf = curl('https://api.gojekapi.com/v2/fund/transfer', '{"amount":"'.$amount.'","description":"ArCode","qr_id":"'.$qrid.'"}', $header);
			$jstf = json_decode($tf[0]);
			$detail = curl('https://api.gojekapi.com/wallet/profile/detailed', null, $header);
			$saldoo = json_decode($detail[0]);
			$saldo = $saldoo->data->balance;
			echo "[+] Sisa Saldo GoPay : Rp ".$saldo."\n";
			echo "\n";
			echo "Proses Transfer Saldo GoPay!\n";
			if ($jstf && true === $jstf->success) {
                echo "Yeah, Berhasil Transfer Saldo GoPay Rp ".$amount." Perak!\n";
                echo "Proses Transfer Saldo GoPay Selesai!\n";
                echo "\n";
			} else {
                echo "Yah, Gagal Transfer Saldo GoPay Ke Akun Kamu!\n";
                echo "\n";
            }

} else if ($type1 == 4) {
// Tools Ganti Nomor INDO Ke US
	echo "\n";
	echo "=====================================================\n";
	echo "              Tools GANTI NOMOR x GOJEK\n";
	echo "           By : Muh. Syahrul Minanul Aziz\n";
	echo "=====================================================\n";
	echo "\n";
	echo "-----------------------------------------------------\n";
	echo "| INFO : 62 Untuk Nomor INDO Dan 1 Untuk Nomor US   |\n";
	echo "| Contoh Nya Begini : - Nomor INDO 6281234567890    |\n";
	echo "|                     - Nomor US 13377352197        |\n";
	echo "| Pastikan Nomor Kamu Sudah Terdaftar Di GOJEK Yah! |\n";
	echo "-----------------------------------------------------\n";
	nomor5_ulang:
	echo "[+] Masukin Nomor GOJEK Kamu Disini : ";
    $nope = trim(fgets(STDIN));
    $login = login($nope);
    if ($login == false)
	    {
		echo "\n";
		echo "Yah Gagal Mengirim Kode OTP, Gunakan Nomor Yang Sudah Terdaftar Di GOJEK Yah!\n";
		echo "\n";
		goto nomor5_ulang;
	    }
      else
	    {
	    otp5_ulang:
		echo "[+] Masukin Kode OTP Kamu Disini : ";
	    $otp = trim(fgets(STDIN));
	    $verif1 = veriflogin($otp, $login);
	if ($verif1 == false)
		{
		echo "\n";
		echo "Yah Kode OTP Salah, Coba Kamu Ulangi Lagi Deh!\n";
		echo "\n";
		goto otp5_ulang;
		}
	  else
		{
		echo "\n";
		nomor6_ulang:
		echo "[+] Masukin Nomor Yang Mau Kamu Ganti : ";
        $nomor = trim(fgets(STDIN));
	    $claim = claim($verif1[3],$nomor,$verif1[1],$verif1[2]);
	if ($claim == false)
		{
		echo "\n";
		echo "Yah Gagal Mengirim Kode OTP, Gunakan Nomor Yang Belum Terdaftar Di GOJEK Yah!\n";
		echo "\n";
		goto nomor6_ulang;
		}
	  else
		{
		otp6_ulang:
		echo "[+] Masukin Kode OTP Kamu Disini : ";
        $OTP = trim(fgets(STDIN));
		$vclaim = verifclaim($verif1[3],$verif1[0],$nomor,$OTP,$claim[1]);
	if ($vclaim == false)
		{
		echo "\n";
		echo "Yah Kode OTP Salah, Coba Kamu Ulangi Lagi Deh!\n";
		echo "\n";
		goto otp6_ulang;
		}
	  else
		{
		echo "\n";
		echo "Yeah, Kamu Berhasil Ganti Nomor Nya Nih!\n";
		echo "\n";
        }
    }
}
}
			
} else if ($type1 == 5) {
// Tools Daftar Akun Baru
	echo "\n";
	echo "=====================================================\n";
	echo "           Tools DAFTAR AKUN BARU x GOJEK\n";
	echo "           By : Muh. Syahrul Minanul Aziz\n";
	echo "=====================================================\n";
	echo "\n";
	echo "-----------------------------------------------------\n";
	echo "| INFO : 62 Untuk Nomor INDO Dan 1 Untuk Nomor US   |\n";
	echo "| Contoh Nya Begini : - Nomor INDO 6281234567890    |\n";
	echo "|                     - Nomor US 13377352197        |\n";
	echo "| Pastikan Nomor Kamu Belum Terdaftar Di GOJEK Yah! |\n";
	echo "-----------------------------------------------------\n";
	nomor7_ulang:
	echo "[+] Masukin Nomor Kamu Disini : ";
	$number = trim(fgets(STDIN));
	$nama = nama();
	$email = strtolower(str_replace(" ", "", $nama) . mt_rand(100,999) . "@gmail.com");
	$data1 = '{"name":"' . $nama . '","email":"' . $email . '","phone":"+' . $number . '","signed_up_country":"ID"}';
	$reg = curl('https://api.gojekapi.com/v5/customers', $data1, $headers);
	$regs = json_decode($reg[0]);
	if($regs->success == true) {
	    otp7_ulang:
		echo "[+] Masukin Kode OTP Kamu Disini : ";
		$otp = trim(fgets(STDIN));
		$data2 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $regs->data->otp_token . '"},"client_secret":"' . $secret . '"}';
		$verif = curl('https://api.gojekapi.com/v5/customers/phone/verify', $data2, $headers);
		$verifs = json_decode($verif[0]);
		if($verifs->success == true) {
		$token = $verifs->data->access_token;
		$headers[] = 'Authorization: Bearer '.$token;
		$live = "token-akun.txt";
		$fopen1 = fopen($live, "a+");
		$fwrite1 = fwrite($fopen1, "Token Kamu : ".$token."\nNomor GoJek Kamu : ".$number."\nKeterangan : 5. Tools DAFTAR AKUN BARU\n\n");
		fclose($fopen1);
		echo "\n";
		echo "Yeah, Pendaftaran Akun GOJEK Kamu Berhasil Nih, ~ Toss Dulu Dong!\n";
		echo "Token Kamu : ".$token."\n";
        echo "Token Berhasil Disimpan Di File ".$live." \n";
        echo "\n";
		} else {
			echo "\n";
			echo "Yah Kode OTP Salah, Coba Kamu Ulangi Lagi Deh!\n";
			echo "\n";
			goto otp7_ulang;
		}
	} else {
		echo "\n";
		echo "Yah Gagal Mengirim Kode OTP, Gunakan Nomor Yang Belum Terdaftar Di GOJEK Yah!\n";
		echo "\n";
		goto nomor7_ulang;
	}

} else if ($type1 == 6) {
// Tools Cek Akun
	echo "\n";
	echo "===================================================\n";
	echo "             Tools CEK AKUN x GOJEK\n";
	echo "         By : Muh. Syahrul Minanul Aziz\n";
	echo "===================================================\n";
	echo "\n";
	echo "---------------------------------------------------\n";
	echo "| INFO : 62 Untuk Nomor INDO Dan 1 Untuk Nomor US |\n";
	echo "| Contoh Nya Begini : - Nomor INDO 6281234567890  |\n";
	echo "|                     - Nomor US 13377352197      |\n";
	echo "---------------------------------------------------\n";
	echo "---------------------------------------------------\n";
	echo "| Fungsi Dari Tools Ini Adalah Untuk Mengecek     |\n";
	echo "| Nomor, Apakah Sudah Terdaftar Atau Belum        |\n";
	echo "---------------------------------------------------\n";
	echo "[+] Masukin Nomor GOJEK Kamu Disini : ";	
	$nope = trim(fgets(STDIN));
	$login = curl('https://api.gojekapi.com/v3/customers/login_with_phone', '{"phone":"+' . $nope . '"}', $headers);
	$logins = json_decode($login[0]);
	if($logins->success == true) {
		echo "\n";
        echo "Yeah, Nomor Kamu Sudah Terdaftar Di GOJEK Nih!\n";
        echo "\n";
		}
	  else
		{
		echo "\n";
        echo "Yeah, Nomor Kamu Belum Terdaftar Di GOJEK Nih!\n";
        echo "\n";
		}

} else if ($type1 == 7) {
// Tools Mendapatkan Token Akun
	echo "\n";
	echo "=====================================================\n";
	echo "        Tools MENDAPATKAN TOKEN AKUN x GOJEK\n";
	echo "           By : Muh. Syahrul Minanul Aziz\n";
	echo "=====================================================\n";
	echo "\n";
	echo "-----------------------------------------------------\n";
	echo "| INFO : 62 Untuk Nomor INDO Dan 1 Untuk Nomor US   |\n";
	echo "| Contoh Nya Begini : - Nomor INDO 6281234567890    |\n";
	echo "|                     - Nomor US 13377352197        |\n";
	echo "| Pastikan Nomor Kamu Sudah Terdaftar Di GOJEK Yah! |\n";
	echo "-----------------------------------------------------\n";
	nomor8_ulang:
	echo "[+] Masukin Nomor GOJEK Kamu Disini : ";
	$number = trim(fgets(STDIN));
	$login = curl('https://api.gojekapi.com/v3/customers/login_with_phone', '{"phone":"+' . $number . '"}', $headers);
	$logins = json_decode($login[0]);
	if ($logins->success == true) {
	    otp8_ulang:
		echo "[+] Masukin Kode OTP Kamu Disini : ";
		$otp = trim(fgets(STDIN));
		$data1 = '{"scopes":"gojek:customer:transaction gojek:customer:readonly","grant_type":"password","login_token":"' . $logins->data->login_token . '","otp":"' . $otp . '","client_id":"gojek:cons:android","client_secret":"' . $secret . '"}';
		$verif = curl('https://api.gojekapi.com/v3/customers/token', $data1, $headers);
		$verifs = json_decode($verif[0]);
		if ($verifs->success == true) {
			$token = $verifs->data->access_token;
			$headers[] = 'Authorization: Bearer '.$token;
			$live = "token-akun.txt";
			$fopen1 = fopen($live, "a+");
			$fwrite1 = fwrite($fopen1, "Token Kamu : ".$token."\nNomor GoJek Kamu : ".$number."\nKeterangan : 7. Tools MENDAPATKAN TOKEN AKUN\n\n");
			fclose($fopen1);
			echo "\n";
			echo "Token Kamu : ".$token."\n";
            echo "Token Berhasil Disimpan Di File ".$live." \n";
            echo "\n";
		} else {
			echo "\n";
			echo "Yah Kode OTP Salah, Coba Kamu Ulangi Lagi Deh!\n";
			echo "\n";
			goto otp8_ulang;
		}
	} else {
		echo "\n";
		echo "Yah Gagal Mengirim Kode OTP, Gunakan Nomor Yang Sudah Terdaftar Di GOJEK Yah!\n";
		echo "\n";
		goto nomor8_ulang;
	}

} else if ($type1 == 8) {
// Tools Daftar Voucher Yang Didapatkan
	echo "\n";
	echo "=====================================================\n";
	echo "    Tools DAFTAR VOUCHER YANG DI DAPATKAN x GOJEK\n";
	echo "           By : Muh. Syahrul Minanul Aziz\n";
	echo "=====================================================\n";
	echo "\n";
	echo "-----------------------------------------------------\n";
	echo "| INFO : 62 Untuk Nomor INDO Dan 1 Untuk Nomor US   |\n";
	echo "| Contoh Nya Begini : - Nomor INDO 6281234567890    |\n";
	echo "|                     - Nomor US 13377352197        |\n";
	echo "| Pastikan Nomor Kamu Sudah Terdaftar Di GOJEK Yah! |\n";
	echo "-----------------------------------------------------\n";
	nomor9_ulang:
	echo "[+] Masukin Nomor GOJEK Kamu Disini : ";
	$number = trim(fgets(STDIN));
	$login = curl('https://api.gojekapi.com/v3/customers/login_with_phone', '{"phone":"+' . $number . '"}', $headers);
	$logins = json_decode($login[0]);
	if ($logins->success == true) {
	    otp9_ulang:
		echo "[+] Masukin Kode OTP Kamu Disini : ";
		$otp = trim(fgets(STDIN));
		$data1 = '{"scopes":"gojek:customer:transaction gojek:customer:readonly","grant_type":"password","login_token":"' . $logins->data->login_token . '","otp":"' . $otp . '","client_id":"gojek:cons:android","client_secret":"' . $secret . '"}';
		$verif = curl('https://api.gojekapi.com/v3/customers/token', $data1, $headers);
		$verifs = json_decode($verif[0]);
		if ($verifs->success == true) {
			$token = $verifs->data->access_token;
			$headers[] = 'Authorization: Bearer '.$token;
			$detail_voucher = curl('https://api.gojekapi.com/gopoints/v3/wallet/vouchers?limit=10&page=1', null, $headers);
			$vouchers = json_decode($detail_voucher[0]);
			$total_voucher = $vouchers->voucher_stats->total_vouchers;
			$nama_voucher = $vouchers->data[0]->title;
			$batas_voucher = $vouchers->data[0]->expiry_date;
			$nama_voucher1 = $vouchers->data[1]->title;
			$batas_voucher1 = $vouchers->data[1]->expiry_date;
			$nama_voucher2 = $vouchers->data[2]->title;
			$batas_voucher2 = $vouchers->data[2]->expiry_date;
			$nama_voucher3 = $vouchers->data[3]->title;
			$batas_voucher3 = $vouchers->data[3]->expiry_date;
			$nama_voucher4 = $vouchers->data[4]->title;
			$batas_voucher4 = $vouchers->data[4]->expiry_date;
			$nama_voucher5 = $vouchers->data[5]->title;
			$batas_voucher5 = $vouchers->data[5]->expiry_date;
			$nama_voucher6 = $vouchers->data[6]->title;
			$batas_voucher6 = $vouchers->data[6]->expiry_date;
			$nama_voucher7 = $vouchers->data[7]->title;
			$batas_voucher7 = $vouchers->data[7]->expiry_date;
			$nama_voucher8 = $vouchers->data[8]->title;
			$batas_voucher8 = $vouchers->data[8]->expiry_date;
			$nama_voucher9 = $vouchers->data[9]->title;
			$batas_voucher9 = $vouchers->data[9]->expiry_date;
			$nama_voucher10 = $vouchers->data[10]->title;
			$batas_voucher10 = $vouchers->data[10]->expiry_date;
			$nama_voucher11 = $vouchers->data[11]->title;
			$batas_voucher11 = $vouchers->data[11]->expiry_date;
			$nama_voucher12 = $vouchers->data[12]->title;
			$batas_voucher12 = $vouchers->data[12]->expiry_date;
			$nama_voucher13 = $vouchers->data[13]->title;
			$batas_voucher13 = $vouchers->data[13]->expiry_date;
			$nama_voucher14 = $vouchers->data[14]->title;
			$batas_voucher14 = $vouchers->data[14]->expiry_date;
            if ($vouchers->success == true) {
            echo "\n";
			echo "Kamu Punya ".$total_voucher." Voucher GOJEK\n";
			echo "\n";
			if ($total_voucher == 1) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
			} else { }
				  if ($total_voucher == 2) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
			} else { }
				  if ($total_voucher == 3) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
			} else { }
				  if ($total_voucher == 4) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher3.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher3.'';
				echo "\n";
			} else { }
				  if ($total_voucher == 5) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher3.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher3.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher4.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher4.'';
				echo "\n";
			} else { }
				  if ($total_voucher == 6) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher3.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher3.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher4.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher4.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher5.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher5.'';
				echo "\n";
			} else { }
				  if ($total_voucher == 7) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher3.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher3.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher4.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher4.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher5.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher5.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher6.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher6.'';
				echo "\n";
			} else { }
				  if ($total_voucher == 8) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher3.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher3.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher4.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher4.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher5.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher5.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher6.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher6.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher7.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher7.'';
				echo "\n";
			} else { }
				  if ($total_voucher == 9) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher3.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher3.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher4.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher4.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher5.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher5.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher6.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher6.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher7.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher7.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher8.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher8.'';
				echo "\n";
			} else { }
				  if ($total_voucher == 10) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher3.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher3.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher4.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher4.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher5.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher5.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher6.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher6.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher7.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher7.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher8.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher8.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher9.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher9.'\n';
				echo "\n";
			} else { }
				  if ($total_voucher == 11) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher3.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher3.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher4.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher4.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher5.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher5.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher6.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher6.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher7.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher7.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher8.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher8.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher9.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher9.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher10.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher10.'\n';
				echo "\n";
			} else { }
				  if ($total_voucher == 12) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher3.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher3.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher4.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher4.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher5.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher5.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher6.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher6.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher7.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher7.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher8.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher8.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher9.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher9.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher10.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher10.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher11.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher11.'\n';
				echo "\n";
			} else { }
				  if ($total_voucher == 13) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher3.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher3.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher4.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher4.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher5.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher5.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher6.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher6.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher7.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher7.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher8.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher8.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher9.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher9.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher10.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher10.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher11.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher11.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher12.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher12.'\n';
				echo "\n";
			} else { }
				  if ($total_voucher == 14) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher3.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher3.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher4.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher4.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher5.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher5.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher6.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher6.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher7.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher7.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher8.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher8.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher9.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher9.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher10.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher10.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher11.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher11.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher12.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher12.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher13.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher13.'\n';
				echo "\n";
			} else { }
				  if ($total_voucher == 15) {
				echo 'Nama Voucher : '.$nama_voucher.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher1.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher1.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher2.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher2.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher3.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher3.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher4.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher4.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher5.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher5.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher6.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher6.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher7.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher7.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher8.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher8.'';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher9.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher9.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher10.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher10.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher11.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher11.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher12.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher12.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher13.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher13.'\n';
				echo "\n";
				echo "\n";
				echo 'Nama Voucher : '.$nama_voucher14.'';
				echo "\n";
				echo 'Tanggal Tidak Berlaku : '.$batas_voucher14.'\n';
				echo "\n";
			}
            echo "\n";
            } else {
				echo "\n";
                echo "Yah Gagal Mengecek Daftar Voucher Yang Ada Di Akun Kamu!\n";
                echo "\n";
            }
		} else {
			echo "\n";
			echo "Yah Kode OTP Salah, Coba Kamu Ulangi Lagi Deh!\n";
			echo "\n";
			goto otp9_ulang;
		}
	} else {
		echo "\n";
		echo "Yah Gagal Mengirim Kode OTP, Gunakan Nomor Yang Sudah Terdaftar Di GOJEK Yah!\n";
		echo "\n";
		goto nomor9_ulang;
	}

} else if ($type1 == 9) {
// Redeem Kode Referral
echo "\n";
echo "===============================================\n";
echo "       Tools Redeem Kode Referral GOJEK\n";
echo "        By : Muh. Syahrul Minanul Aziz\n";
echo "===============================================\n";
echo "\n";
echo "Silahkan Pilih Salah Satu Dibawah Ini :\n";
echo "1. Masuk (Akun Lama)\n";
echo "2. Daftar (Akun Baru)\n";
echo "[+] Masukin Salah Satu Nomor Diatas Nya Disini : ";
$redeem1 = trim(fgets(STDIN));
if ($redeem1 == "1")
	{
		echo "\n";
		echo "====================================================\n";
		echo "    Tools MASUK AKUN + REDEEM KODE REFERRAL GOJEK\n";
		echo "           By : Muh. Syahrul Minanul Aziz\n";
		echo "====================================================\n";
		echo "\n";
		echo "----------------------------------------------------\n";
		echo "| INFO : 62 Untuk Nomor INDO Dan 1 Untuk Nomor US  |\n";
		echo "| Contoh Nya Begini : - Nomor INDO 6281234567890   |\n";
		echo "|                     - Nomor US 13377352197       |\n";
		echo "----------------------------------------------------\n";
		nomor1_ulang:
		echo "[+] Masukin Nomor GOJEK Kamu Disini : ";
		$number = trim(fgets(STDIN));
		$login = curl('https://api.gojekapi.com/v3/customers/login_with_phone', '{"phone":"+' . $number . '"}', $headers);
		$logins = json_decode($login[0]);
		if($logins->success == true) {
		    otp1_ulang:
			echo "[+] Masukin Kode OTP Kamu Disini : ";
			$otp = trim(fgets(STDIN));
			$data1 = '{"scopes":"gojek:customer:transaction gojek:customer:readonly","grant_type":"password","login_token":"' . $logins->data->login_token . '","otp":"' . $otp . '","client_id":"gojek:cons:android","client_secret":"' . $secret . '"}';
			$verif = curl('https://api.gojekapi.com/v3/customers/token', $data1, $headers);
			$verifs = json_decode($verif[0]);
			if($verifs->success == true) {
				$token = $verifs->data->access_token;
				$headers[] = 'Authorization: Bearer '.$token;
				$live = "token-akun.txt";
                $fopen1 = fopen($live, "a+");
                $fwrite1 = fwrite($fopen1, "Token Kamu : ".$token."\nNomor GoJek Kamu : ".$number."\nKeterangan : 1. Tools MASUK AKUN + REEDEM KODE REFERRAL GOJEK\n\n");
				fclose($fopen1);
				echo "\n";
				echo "Token Kamu : ".$token."\n";
				echo "Token Berhasil Disimpan Di File ".$live." \n";
				echo "\n";
				echo "[+] Masukin Kode Referral GOJEK Nya Disini : ";
				$kode = trim(fgets(STDIN));
				echo "\n";
				$data3 = '{"promo_code":"'.$kode.'"}';
				$claim = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data3, $headers);
				$claims = json_decode($claim[0]);
				echo "Proses Redeem Kode Referral!\n";
				echo "Redeem Kode Referral : $kode\n";
				if ($claims->success == true) {
					echo "Berhasil Redeem Kode Referral, ~ Toss Dulu Dong!\n";
                    echo "Proses Redeem Kode Referral Selesai!\n";
                    echo "\n";
					} else {
                        echo "Gagal Redeem Kode Referral!\n";
                        echo "\n";
					}
			} else {
				echo "\n";
				echo "Yah Kode OTP Salah, Coba Kamu Ulangi Lagi Deh!\n";
				echo "\n";
				goto otp1_ulang;
			}
		} else {
			echo "\n";
			echo "Yah Gagal Mengirim Kode OTP, Gunakan Nomor Yang Sudah Terdaftar Di GOJEK Yah!\n";
			echo "\n";
			goto nomor1_ulang;
		}
	} else if ($redeem1 == "2")
	{
		echo "\n";
		echo "========================================================\n";
		echo "   Tools DAFTAR AKUN BARU + REDEEM KODE REFERRAL GOJEK\n";
		echo "             By : Muh. Syahrul Minanul Aziz\n";
		echo "========================================================\n";
		echo "\n";
		echo "--------------------------------------------------------\n";
		echo "| INFO : 62 Untuk Nomor INDO Dan 1 Untuk Nomor US      |\n";
		echo "| Contoh Nya Begini : - Nomor INDO 6281234567890       |\n";
		echo "|                     - Nomor US 13377352197           |\n";
		echo "| Pastikan Nomor Kamu Belum Terdaftar Di GOJEK Yah!    |\n";
		echo "--------------------------------------------------------\n";
		nomor2_ulang:
		echo "[+] Masukin Nomor Kamu Disini : ";
		$number = trim(fgets(STDIN));
		$nama = nama();
		$email = strtolower(str_replace(" ", "", $nama) . mt_rand(100,999) . "@gmail.com");
		$data1 = '{"name":"' . $nama . '","email":"' . $email . '","phone":"+' . $number . '","signed_up_country":"ID"}';
		$reg = curl('https://api.gojekapi.com/v5/customers', $data1, $headers);
		$regs = json_decode($reg[0]);
		if($regs->success == true) {
			otp2_ulang:
			echo "[+] Masukin Kode OTP Kamu Disini : ";
			$otp = trim(fgets(STDIN));
			$data2 = '{"client_name":"gojek:cons:android","data":{"otp":"' . $otp . '","otp_token":"' . $regs->data->otp_token . '"},"client_secret":"' . $secret . '"}';
			$verif = curl('https://api.gojekapi.com/v5/customers/phone/verify', $data2, $headers);
			$verifs = json_decode($verif[0]);
			if($verifs->success == true) {
				$token = $verifs->data->access_token;
				$headers[] = 'Authorization: Bearer '.$token;
				$live = "token-akun.txt";
                $fopen1 = fopen($live, "a+");
                $fwrite1 = fwrite($fopen1, "Token Kamu : ".$token."\nNomor GoJek Kamu : ".$number."\nKeterangan : 1. Tools DAFTAR AKUN BARU + REEDEM KODE REFERRAL GOJEK\n");
				fclose($fopen1);
				echo "\n";
				echo "Token Kamu : ".$token."\n";
				echo "Token Berhasil Disimpan Di File ".$live." \n";
				echo "\n";
				echo "[+] Masukin Kode Referral GOJEK Nya Disini : ";
				$kode = trim(fgets(STDIN));
				echo "\n";
				$data3 = '{"promo_code":"'.$kode.'"}';
				$claim = curl('https://api.gojekapi.com/go-promotions/v1/promotions/enrollments', $data3, $headers);
				$claims = json_decode($claim[0]);
				echo "Proses Redeem Kode Referral!\n";
				echo "Redeem Kode Referral : $kode\n";
				if ($claims->success == true) {
					echo "Berhasil Redeem Kode Referral, ~ Toss Dulu Dong!\n";
                    echo "Proses Redeem Kode Referral Selesai!\n";
                    echo "\n";
					} else {
                        echo "Gagal Mendapatkan Referral!!\n";
                        echo "\n";
					}
			} else {
				echo "\n";
				echo "Yah Kode OTP Salah, Coba Kamu Ulangi Lagi Deh!\n";
				echo "\n";
				goto otp2_ulang;
			}
		} else {
			echo "\n";
			echo "Yah Gagal Mengirim Kode OTP, Gunakan Nomor Yang Belum Terdaftar Di GOJEK Yah!\n";
			echo "\n";
			goto nomor2_ulang;
		}
	}

function nama()
	{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, "http://ninjaname.horseridersupply.com/indonesian_name.php");
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	$ex = curl_exec($ch);
	// $rand = json_decode($rnd_get, true);
	preg_match_all('~(&bull; (.*?)<br/>&bull; )~', $ex, $name);
	return $name[2][mt_rand(0, 14) ];
	}

function login($no)
	{
	$data = '{"phone":"+'.$no.'"}';
	$register = post("/v4/customers/login_with_phone", "", $data);
	if ($register['success'] == 1)
		{
		return $register['data']['login_token'];
		}
	  else
		{
		return false;
		}
	}
function veriflogin($otp, $token)
	{
	$data = '{"client_name":"gojek:cons:android","client_secret":"83415d06-ec4e-11e6-a41b-6c40088ab51e","data":{"otp":"'.$otp.'","otp_token":"'.$token.'"},"grant_type":"otp","scopes":"gojek:customer:transaction gojek:customer:readonly"}';
	$verif1 = post("/v4/customers/login/verify", "", $data);
	if ($verif1['success'] == 1)
		{
		$access = $verif1['data']['access_token'];
        $cust = $verif1['data']['customer']['id'];
		$my_mail = $verif1['data']['customer']['email'];
		$my_name = $verif1['data']['customer']['name'];
		$result = array($cust,$my_mail,$my_name,$access);
		
		return $result;
		}
	  else
		{
		return false;
		}
	}
function claim($token,$nomor,$my_mail,$my_name)
	{
	$Pdata = '{"email":"'.$my_mail.'","name":"'.$my_name.'","phone":"+'.$nomor.'"}';
	$claim = patch($token, $Pdata);
	if ($claim[0]['success'] == 1)
		{
		$message_patch = $claim[0]['data']['message'];
		$GPToken = $claim[1]['GPToken'];
		$result = array($message_patch,$GPToken);
		return $result;
		}
	  else
		{
		return false;
		}
	}
function verifclaim($token,$cust,$nomor,$code,$gptoken)
	{
	$data = '{"id":"'.$cust.'","phone":"+'.$nomor.'","verificationCode":"'.$code.'"}';
	$claim1 = post("/v4/customer/verificationUpdateProfile", $token, $data, $gptoken, $cust);
	if ($claim1['success'] == 1)
		{
		return $claim1['data']['message'];
		}
	  else
		{
		return false;
		}
	}

function post($url, $token = null, $data = null, $gptoken = null, $cust = null){
$header[] = "Host: api.gojekapi.com";
$header[] = "User-Agent: okhttp/3.10.0";
$header[] = "Accept: application/json";
$header[] = "Accept-Language: en-ID";
$header[] = "Content-Type: application/json; charset=UTF-8";
$header[] = "X-AppVersion: 3.30.2";
$header[] = "X-UniqueId: ".time()."57".mt_rand(1000,9999);
$header[] = "Connection: keep-alive";
$header[] = "X-User-Locale: en_ID";
if ($token):
$header[] = "Authorization: Bearer $token";
endif;
if($gptoken):
$header[] = "GPToken: $gptoken";
endif;
if($cust):
$header[] = "User-uuid: $cust";
endif;

$c = curl_init("https://api.gojekapi.com".$url);
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
    if ($data):
    curl_setopt($c, CURLOPT_POSTFIELDS, $data);
    curl_setopt($c, CURLOPT_POST, true);
    endif;
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_HEADER, true);
    curl_setopt($c, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($c);
    $httpcode = curl_getinfo($c);
    if (!$httpcode)
        return false;
    else {
        $header = substr($response, 0, curl_getinfo($c, CURLINFO_HEADER_SIZE));
        $body   = substr($response, curl_getinfo($c, CURLINFO_HEADER_SIZE));
    }
    $json = json_decode($body, true);
    return $json;
}
function save($filename, $content)
{
	$save = fopen($filename, "a");
	fputs($save, "$content\r\n");
	fclose($save);
}

function patch($token = null,$Pdata = null)
{
$header[] = "Host: api.gojekapi.com";
$header[] = "User-Agent: okhttp/3.10.0";
$header[] = "Accept: application/json";
$header[] = "Accept-Language: en-ID";
$header[] = "Content-Type: application/json; charset=UTF-8";
$header[] = "X-AppVersion: 3.30.2";
$header[] = "X-UniqueId: ".time()."57".mt_rand(1000,9999);
$header[] = "Connection: keep-alive";
$header[] = "X-User-Locale: en_ID";
if ($token):
$header[] = "Authorization: Bearer $token";
endif;
$c = curl_init("https://api.gojekapi.com/v4/customers");
    curl_setopt($c, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($c, CURLOPT_SSL_VERIFYPEER, false);
	if ($Pdata):
    curl_setopt($c, CURLOPT_CUSTOMREQUEST, 'PATCH');
	curl_setopt($c, CURLOPT_POSTFIELDS, $Pdata);
    curl_setopt($c, CURLOPT_POST, true);
    endif;
    curl_setopt($c, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_HEADER, true);
    curl_setopt($c, CURLOPT_HTTPHEADER, $header);
    $response = curl_exec($c);
    $httpcode = curl_getinfo($c);
    if (!$httpcode)
        return false;
    else 
	{
		$headers = [];
		$response = rtrim($response);
		$data = explode("\n",$response);
		$headers['status'] = $data[0];
		array_shift($data);

			foreach($data as $part){

					$middle = explode(":",$part,2);

					if ( !isset($middle[1]) ) { $middle[1] = null; }

					$headers[trim($middle[0])] = trim($middle[1]);
				}

		$body   = substr($response, curl_getinfo($c, CURLINFO_HEADER_SIZE));
	}

    $json = json_decode($body, true);
	$result = array($json,$headers);
	return $result;
}

function curl($url, $fields = null, $headers = null)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        if ($fields !== null) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        }
        if ($headers !== null) {
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $result   = curl_exec($ch);
        $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        return array(
            $result,
            $httpcode
        );
	}