<?php

class BarangController extends Controller
{
	
	public $layout='//layouts/column2';

	public function filterCheckPrivilages($filterChain)
	{
		$accessController = new AccessController();
		if(!$accessController->isAllowed())
		{
		//redirect ke form login
			if(Yii::App()->user->isGuest)
			{
				$this->redirect(array('site/alertLogin'));
			}
			else
			{
				$this->redirect(Yii::app()->user->returnUrl);
			}
		}
		$filterChain->run();
	}


	public function filters()
	{
		//applikasikan filter ke semua action
		return array(
			'checkPrivilages',
		);
	}

	public function actionAdd($id)
	{
		$model=$this->loadModel($id);
		$pemasukan = new Pemasukan;
		$gudang = new BarangGudang;
	

		if(isset($_POST['Pemasukan']))
		{
			if(isset($_POST['BarangGudang']))
			{
				
					$pemasukan->attributes=$_POST['Pemasukan'];
					$gudang->attributes=$_POST['BarangGudang'];
					$model->jumlah_baik=$_POST['jumlah_baik'];
					$model->jumlah_buruk=$_POST['jumlah_buruk'];
					if($model->validate() && $this->checkTanggal($pemasukan->tgl_pemasukan))
					{
						$model->jumlah_baik=$model->jumlah_baik+$_POST['jumlah_baik'];
						$model->jumlah_buruk=$model->jumlah_buruk+$_POST['jumlah_buruk'];
						$pemasukan->jumlah=$_POST['jumlah_baik']+$_POST['jumlah_buruk'];

						$addbarang = $this->loadGudang($model->id,$gudang->id_gudang);

						if ($addbarang===null)
						{
							$newbarang=new BarangGudang;
							$newbarang->id_gudang=$gudang->id_gudang;
							$newbarang->id_barang=$model->id;
							$newbarang->jumlah=$pemasukan->jumlah;
							
						}
						else
						{
							$addbarang->jumlah = $addbarang->jumlah + $pemasukan->jumlah;
						}

						$pemasukan->id_pemasukan_barang=$model->id;

						$username = Yii::app()->user->name;
						$user=User::model()->findByAttributes(
							array('nkey'=>$username));
						$pemasukan->id_pemasukan_user=$user->id;
						$pemasukan->id_pemasukan_gudang=$gudang->id_gudang;

						$model->jumlah=$model->jumlah+$pemasukan->jumlah;
					}
					
					if($model->validate())
					{
						if($pemasukan->save()&& $model->save()&& ($addbarang===null ? $newbarang->save(): $addbarang->save()))
						{
							$this->redirect(array('index'));
						}
					}
				
			}
		}

		$this->render('create',array(
			'model'=>$model,'pemasukan'=>$pemasukan,'gudang'=>$gudang,
		));
	}

	public function actionCreate()
	{
		$model = new Barang;
		$pemasukan = new Pemasukan;
		$gudang = new BarangGudang;

		if(isset($_POST['Pemasukan']))		
		{
			if(isset($_POST['Barang']))
			{
				if(isset($_POST['BarangGudang']))
				{
					$pemasukan->attributes=$_POST['Pemasukan'];
					$model->attributes=$_POST['Barang'];
					$gudang->attributes=$_POST['BarangGudang'];
					$model->jumlah_baik=$_POST['jumlah_baik'];
					$model->jumlah_buruk=$_POST['jumlah_buruk'];
					$pemasukan->jumlah=$model->jumlah_baik+$model->jumlah_buruk;
					$model->jumlah=$pemasukan->jumlah;
					$model->deskripsi=$pemasukan->keterangan;

					$username = Yii::app()->user->name;
					$user=User::model()->findByAttributes(
						array('nkey'=>$username));
					$pemasukan->id_pemasukan_user=$user->id;
					$pemasukan->id_pemasukan_gudang=$gudang->id_gudang;

					$gudang->jumlah = $pemasukan->jumlah;

					$model->url_gambar=CUploadedFile::getInstance($model,'url_gambar');

					if($this->checkTanggal($pemasukan->tgl_pemasukan))
					{
						if($model->save())
						{
							if (isset($model->url_gambar))
							{
								$model->url_gambar->saveAs($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/images/barang/'.$model->url_gambar);
							}
							
							$pemasukan->id_pemasukan_barang=$model->id;
							$gudang->id_barang =$model->id;
							if($pemasukan->save() && $gudang->save())
							{
								$this->redirect(array('index'));
							}
						}
					}
				}
			}
		}

		$this->render('create',array(
			'model'=>$model,'pemasukan'=>$pemasukan,'gudang'=>$gudang,
		));
	}
	
	
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		if(isset($_POST['Barang']))
		{
			$model->attributes=$_POST['Barang'];
			$model->jumlah_baik=$_POST['jumlah_baik'];
			$model->jumlah_buruk=$_POST['jumlah_buruk'];
			if($model->validate())
			{
				$model->jumlah=$_POST['jumlah_baik']+$_POST['jumlah_buruk'];
				$model->url_gambar=CUploadedFile::getInstance($model,'url_gambar');
				if($model->save())
				{
					if (isset($model->url_gambar))
					{
						$model->url_gambar->saveAs($_SERVER['DOCUMENT_ROOT'].Yii::app()->request->baseUrl.'/images/barang/'.$model->url_gambar);
					}
					$this->redirect(array('index'));
				}
			}
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionView()
	{
		$model = Barang::model()->findByPk($_GET['id']);
		$gudang= BarangGudang::model()->findAllByAttributes(array('id_barang'=>$_GET['id']));
		$test='';
		if(isset($gudang))
		{
			foreach ($gudang as $g)
			{
				$lokasi=Gudang::model()->findByAttributes(array('id'=>$g->id_gudang));
				$test=$test.strval($lokasi->nama).": ".strval($g->jumlah).", ";
			}
		}

		if (Yii::app()->request->isAjaxRequest) 
		{
			     $this->renderPartial('view', array(
                                   'model'=>$model,
									'gudang'=>$test,
                                   'asDialog'=>!empty($_GET['asDialog']),
                                 ),
                          false,true);
			Yii::app()->end();
		}
	}

	public function actionPinjam($id)
	{
		$peminjaman = new Peminjaman;
		$model=$this->loadModel($id);

		if(isset($_POST['Peminjaman']))
		{
			$peminjaman->attributes=$_POST['Peminjaman'];

			$username = Yii::app()->user->name;
			$user=User::model()->findByAttributes(
					array('nkey'=>$username));

			$peminjaman->id_peminjaman_user=$user->id;
			$peminjaman->id_peminjaman_barang=$model->id;
			
			$nama=$user->nickname;
			$dataform=array('nama'=>$nama,'nim'=>$username,'date'=>$peminjaman->tgl_peminjaman,
							'barang'=>array('id'=>$model->id,'namabarang'=>$model->nama,'jumlah'=>$peminjaman->jumlah),
						);

			if($this->checkTanggal($peminjaman->tgl_peminjaman))
			{
				if($peminjaman->save() && $model->save())
				{
					
						$this->redirect(array('site/alertPinjam'));
				}
			}
		}
		
		$this->render('pinjam',array(
			'model'=>$model,'peminjaman'=>$peminjaman,
		));
	}

	public function actionBarangKeluar($id)
	{
		$model=$this->loadModel($id);
		$pengeluaran = new Pengeluaran;
		$gudang = new BarangGudang;

		if(isset($_POST['Pengeluaran']))
		{
			$pengeluaran->attributes=$_POST['Pengeluaran'];
			
			$outbarang = $this->loadGudang($model->id,$_POST['locate']);

			if ($outbarang===null)
			{
				throw new CHttpException(404,'Tidak tersedia barang di gudang');
			}
			else
			{
				$username = Yii::app()->user->name;
				$user=User::model()->findByAttributes(
					array('nkey'=>$username));

				$pengeluaran->id_pengeluaran_user=$user->id;
				$pengeluaran->id_pengeluaran_barang=$model->id;
				$pengeluaran->id_pengeluaran_gudang=$_POST['locate'];
				$pengeluaran->jumlah=$_POST['jumlah_baik']+$_POST['jumlah_buruk'];

				$model->jumlah_baik = $model->jumlah_baik - $_POST['jumlah_baik'];
				$model->jumlah_buruk = $model->jumlah_buruk - $_POST['jumlah_buruk'];
				$model->jumlah = $model->jumlah - $pengeluaran->jumlah;
				$outbarang->jumlah=$outbarang->jumlah-$pengeluaran->jumlah;

				$addbarang = $this->loadGudang($model->id,$_POST['lokasi']);

				if ($addbarang===null)
				{
					$newbarang=new BarangGudang;
					$newbarang->id_gudang=$_POST['lokasi'];
					$newbarang->id_barang=$model->id;
					$newbarang->jumlah=$pengeluaran->jumlah;
					
				}
				else
				{
					$addbarang->jumlah = $addbarang->jumlah + $pengeluaran->jumlah;
				}

				$outbarang->jumlah = $outbarang->jumlah - $pengeluaran->jumlah;

				if($this->checkTanggal($pengeluaran->tgl_pengeluaran))
				{
					if($pengeluaran->save() && $model->save() && $outbarang->save() && ($addbarang===null ? $newbarang->save(): $addbarang->save()))
					{
						$this->redirect(array('index'));
					}
				}
			}
		}

		$this->render('pengeluaran',array(
			'model'=>$model,'pengeluaran'=>$pengeluaran,'gudang'=>$gudang,
		));
	}

	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	public function actionIndex()
	{
		$model=new Barang('search');
		$model->unsetAttributes(); 
		if(isset($_GET['Barang']))
			$model->attributes=$_GET['Barang'];

		$keyword='';
		if(isset($_GET['cari']))
			$keyword=$_GET['cari'];

		$this->render('index',array(
			'model'=>$model,
			'keyword'=>$keyword,
		));
	}

	public function loadModel($id)
	{
		$model=Barang::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	public function loadGudang($id_barang,$id_gudang)
	{
		$model=BarangGudang::model()->findByAttributes(array('id_barang'=>$id_barang,'id_gudang'=>$id_gudang));
		return $model;
	}

	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='barang-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	public function actionListPemasukan()
	{
		$model=new Pemasukan('search');

		$model->unsetAttributes(); 
		if(isset($_GET['Pemasukan']))
			$model->attributes=$_GET['Pemasukan'];

		$keyword='';
		if(isset($_GET['cari']))
			$keyword=$_GET['cari'];


		$this->render('listPemasukan',array(
			'model'=>$model,
			'keyword'=>$keyword,
		));
	}

	public function actionListPeminjaman()
	{
		$model=new Peminjaman('search');

		$model->unsetAttributes(); 
		if(isset($_GET['Peminjaman']))
			$model->attributes=$_GET['Peminjaman'];

		$keyword='';
		if(isset($_GET['cari']))
			$keyword=$_GET['cari'];

		$this->render('listPeminjaman',array(
			'model'=>$model,
			'keyword'=>$keyword,
		));
	}
	
	public function actionListPengeluaran()
	{
		$model=new Pengeluaran('search');

		$model->unsetAttributes(); 
		if(isset($_GET['Pengeluaran']))
			$model->attributes=$_GET['Pengeluaran'];

		
		$keyword='';
		if(isset($_GET['cari']))
			$keyword=$_GET['cari'];

		$this->render('listPengeluaran',array(
			'model'=>$model,
			'keyword'=>$keyword,
		));
	}

	public function periksaRole($user)
	{

		$role = UserRole::model()->findByAttributes(array('key_sys_user'=>$user));

		$userRole='';
		if(isset($role->key_sys_role))
		{
			return $role->key_sys_role;
		}
		else
		{
			return $userRole;
		}
	}

	public function actionApproval()
	{
		
		$model = Peminjaman::model()->findByPk($_GET['id']);
		
		if(isset($_GET['setuju']))
		{
			$peminjaman=Peminjaman::model()->findByPk($_GET['id']);

			if($_GET['setuju']==1)
			{
				
				$peminjaman->status_approval="setuju";
				$user=User::model()->findByAttributes(array('id'=>$peminjaman->id_peminjaman_user));
				$barang=Barang::model()->findByAttributes(array('id'=>$peminjaman->id_peminjaman_barang));

				if($peminjaman->save())
				{
					$message = "Yth. " . $user->nickname . ",\n\n"
					."   Permintaan peminjaman barang yang anda lakukan telah disetujui dengan spesifikasi: \n"
					."ID Barang: ".$peminjaman->id_peminjaman_barang."\n"
					."Nama Barang: ".$barang->nama."\n"
					."Jumlah: ".$peminjaman->jumlah."\n"
					."   Anda dapat mengambil barang tersebut di bagian Inventory.\n"
					."Atas perhatiannya, kami mengucapkan terima kasih \n\n"
					."Hormat kami,\n"
					."--\n"
					."Inventory Del\n"
					."admin@inventory.del.com"
					;

					Yii::app()->mailer->Host = 'localhost';
					Yii::app()->mailer->From = 'admin@inventory.del.com';
					Yii::app()->mailer->FromName = 'App Inventory';
					Yii::app()->mailer->IsSMTP();
					Yii::app()->mailer->AddAddress($user->email);
					Yii::app()->mailer->Subject = 'Konfirmasi Peminjaman Barang Inventory';
					Yii::app()->mailer->Body = $message;
					Yii::app()->mailer->Send();
			

					$this->redirect(array('listPeminjaman'));
				}
			}
			else
			{
				$peminjaman->status_approval="tidaksetuju";
				$user=User::model()->findByAttributes(array('id'=>$peminjaman->id_peminjaman_user));

				if($peminjaman->save())
				{
					$message = "Yth. " . $user->nickname . ",\n\n"
					."   Permintaan peminjaman barang yang anda lakukan tidak dapat disetujui.\n"
					."Atas perhatiannya, kami mengucapkan terima kasih \n\n"
					."Hormat kami,\n"
					."--\n"
					."Inventory Del\n"
					."admin@inventory.del.com"
					;

					Yii::app()->mailer->Host = 'localhost';
					Yii::app()->mailer->From = 'admin@inventory.del.com';
					Yii::app()->mailer->FromName = 'App Inventory';
					Yii::app()->mailer->IsSMTP();
					Yii::app()->mailer->AddAddress($user->email);
					Yii::app()->mailer->Subject = 'Konfirmasi Peminjaman Barang Inventory';
					Yii::app()->mailer->Body = $message;
					Yii::app()->mailer->Send();

					$this->redirect(array('listPeminjaman'));
				}
	
			}
		}

		$this->render('approve',array('model'=>$model));                 
	}

	public function actionSimpanBarang()
	{
		$model = new Penyimpanan();

		if(isset($_POST['Penyimpanan']))		
		{
			$model->attributes=$_POST['Penyimpanan'];

			if($_POST['jumlah']<=0 && $model->validate())
			{
				Yii::app()->user->setFlash('error', "Jumlah jenis barang harus integer dan tidak boleh kosong.");
			}
			else if($this->checkTanggal($model->tgl_penyimpanan))
			{
				if($model->save())
				{
					$this->redirect(array('tambahBarangSimpan','jumlah'=>$_POST['jumlah'],'id'=>$model->id,));
				}
			}
		}

		$this->render('simpan',array(
			'model'=>$model,
		));
	}
	public function actionTambahBarangSimpan()
	{

		if(isset($_POST['jumlah'][0]) && isset($_POST['jumlah'][1]))
		{

			$jumlah=$_POST['jumlah'];
			$jlh=count($jumlah);
			$model=Penyimpanan::model()->findByPk($_GET['id']);
			if(!isset($model->penyimpan))
			{
				Yii::app()->user->setFlash('error', "Nama pemohon belum diisi");
				$this->redirect(array('simpanBarang'));

			}
			$p=$model->penyimpan;
			$tanggal=$model->tgl_penyimpanan;
			$ket=$model->keterangan;

			$model->delete();
			
			for($i=0;$i<$jlh;$i++)
			{
				$simpan= new Penyimpanan();
				$simpan->penyimpan=	$p;
				$simpan->tgl_penyimpanan=$tanggal;
				$simpan->keterangan=$ket;
				$simpan->nama_barang=$jumlah[$i][0];
				$simpan->jumlah=$jumlah[$i][1];
				$simpan->spesifikasi=$jumlah[$i][2];
				$simpan->kondisi=$jumlah[$i][3];
				
				
				$simpan->save();
				
			}
			$counter="SELECT SUM(jumlah) FROM inv_t_penyimpanan WHERE penyimpan='".$p."' AND tgl_penyimpanan='".$tanggal."'";
			$count=Yii::app()->db->createCommand($counter)->queryScalar();
		
			$berita=Penyimpanan::model()->findAllByAttributes(array('penyimpan'=>$model->penyimpan,'tgl_penyimpanan'=>$model->tgl_penyimpanan));
			
			$html2pdf = Yii::app()->ePdf->HTML2PDF();
			$html2pdf->WriteHTML($this->renderPartial('beritaAcara', array('berita'=>$berita,'penyimpan'=>$model->penyimpan,'sum'=>$count), true));
			$html2pdf->Output();

			//$this->redirect(array('index'));
		}
			
		$this->render('_form_barang',array(
			'jumlah'=>$_GET['jumlah'],'id'=>$_GET['id'],
		));
	}

	public function actionStockOpname()
	{
		
		if(empty($_GET['transaksi']) || empty($_GET['bulan']) || empty($_GET['tahun']))
		{
			$count=Yii::app()->db->createCommand('SELECT COUNT(*) FROM inv_m_barang')->queryScalar();
			$sql="SELECT id,nama AS Nama,jumlah AS Jumlah,deskripsi AS Deskripsi FROM inv_m_barang";

				$barang = new CSqlDataProvider($sql,array(
					'totalItemCount'=>$count,
					'keyField'=>'id',
					'sort'=>array(
						'attributes'=>array(
							'Week',
						),
					),
					'pagination'=>array(
						'pageSize'=>10
					),
				
				));
			
			$this->render('stockOpname',array(
				'model'=>$barang,
			));
		}
		else
		{	
			if($_GET['transaksi']=='peminjaman')
			{
				$counter="SELECT COUNT(*) FROM inv_t_peminjaman WHERE YEAR(tgl_peminjaman)='".$_GET['tahun']."' AND MONTH(tgl_peminjaman)='".$_GET['bulan']."'";

				$count=Yii::app()->db->createCommand($counter)->queryScalar();
				$sql="SELECT id_peminjaman_barang,sys_m_user.nickname AS Nama,inv_m_barang.nama AS Nama_Barang,inv_t_peminjaman.tgl_peminjaman AS Tanggal_Peminjaman,inv_t_peminjaman.jumlah AS Jumlah
				FROM inv_t_peminjaman
				INNER JOIN inv_m_barang 
				ON inv_t_peminjaman.id_peminjaman_barang=inv_m_barang.id 
				INNER JOIN sys_m_user 
				ON inv_t_peminjaman.id_peminjaman_user=sys_m_user.id "
				."WHERE YEAR(tgl_peminjaman)='".$_GET['tahun']."' AND MONTH(tgl_peminjaman)='".$_GET['bulan']."'";

					$barang = new CSqlDataProvider($sql,array(
						'totalItemCount'=>$count,
						'keyField'=>'id_peminjaman_barang',
						'sort'=>array(
							'attributes'=>array(
								'tgl_peminjaman',
							),
						),
						'pagination'=>array(
							'pageSize'=>10
						),
					
					));
				
				$this->render('stockOpname',array(
					'model'=>$barang,
				));
			}
			else if($_GET['transaksi']=='pengeluaran')
			{
				$counter="SELECT COUNT(*) FROM inv_t_pengeluaran WHERE YEAR(tgl_pengeluaran)='".$_GET['tahun']."' AND MONTH(tgl_pengeluaran)='".$_GET['bulan']."'";

				$count=Yii::app()->db->createCommand($counter)->queryScalar();

				$sql="SELECT inv_t_pengeluaran.id_pengeluaran_barang,sys_m_user.nickname,inv_m_barang.nama,inv_t_pengeluaran.tgl_pengeluaran,inv_t_pengeluaran.jumlah 
				FROM inv_t_pengeluaran 
				INNER JOIN inv_m_barang 
				ON inv_t_pengeluaran.id_pengeluaran_barang=inv_m_barang.id 
				INNER JOIN sys_m_user 
				ON inv_t_pengeluaran.id_pengeluaran_user=sys_m_user.id 
				WHERE YEAR(tgl_pengeluaran)='".$_GET['tahun']."' AND MONTH(tgl_pengeluaran)='".$_GET['bulan']."'";

					$barang = new CSqlDataProvider($sql,array(
						'totalItemCount'=>$count,
						'keyField'=>'id_pengeluaran_barang',
						'sort'=>array(
							'attributes'=>array(
								'tgl_pengeluaran',
							),
						),
						'pagination'=>array(
							'pageSize'=>10
						),
					
					));
				
				$this->render('stockOpname',array(
					'model'=>$barang,
				));
			}
			else if($_GET['transaksi']=='pemasukan')
			{
				
				$counter="SELECT COUNT(*) FROM inv_t_pemasukan WHERE YEAR(tgl_pemasukan)='".$_GET['tahun']."' AND MONTH(tgl_pemasukan)='".$_GET['bulan']."'";
				$count=Yii::app()->db->createCommand($counter)->queryScalar();
				$sql="SELECT id_pemasukan_barang,sys_m_user.nickname,inv_m_barang.nama,inv_t_pemasukan.tgl_pemasukan,inv_t_pemasukan.jumlah 
				FROM inv_t_pemasukan 
				INNER JOIN inv_m_barang 
				ON inv_t_pemasukan.id_pemasukan_barang=inv_m_barang.id 
				INNER JOIN sys_m_user 
				ON inv_t_pemasukan.id_pemasukan_user=sys_m_user.id 
				WHERE YEAR(tgl_pemasukan)='".$_GET['tahun']."' AND MONTH(tgl_pemasukan)='".$_GET['bulan']."'";

					$barang = new CSqlDataProvider($sql,array(
						'totalItemCount'=>$count,
						'keyField'=>'id_pemasukan_barang',
						'sort'=>array(
							'attributes'=>array(
								'tgl_pemasukan',
							),
						),
						'pagination'=>array(
							'pageSize'=>10
						),
					
					));
				
				$this->render('stockOpname',array(
					'model'=>$barang,
				));
			}
		}

	}

	public function actionLaporanKerusakan($id)
	{
		$model=Barang::model()->findByPk($id);
		if(isset($_POST['lap']))
		{
			if($_POST['lap']['4']=="")
			{
				Yii::app()->user->setFlash('error', "Nama pemohon tidak boleh kosong.");
			}
			else if($_POST['lap']['6']<=0)
			{
				Yii::app()->user->setFlash('error', "Jumlah barang yang diperbaiki harus integer dan tidak boleh kosong.");
			}
			else if($_POST['lap']['6']>$model->jumlah_buruk)
			{
				Yii::app()->user->setFlash('error', "Jumlah barang yang diperbaiki harus lebih kecil atau sama dengan jumlah buruk.");
			}
			else
			{	
				$html2pdf = Yii::app()->ePdf->HTML2PDF();
				$html2pdf->WriteHTML($this->renderPartial('laporanKerusakan', array('model'=>$model,'pemohon'=>$_POST['lap']['4'],'desk'=>$_POST['lap']['5'],'diperbaiki'=>$_POST['lap']['6']), true));
				$html2pdf->Output();
			}
		}
		$this->render('_form_laporan_rusak',array('model'=>$model));
	}


	public function checkTanggal($tgl)
	{
		if($tgl!=date("Y-".str_pad("n" , 2, '0', STR_PAD_LEFT)."-j"))
		{
				Yii::app()->user->setFlash('error', "Tanggal transaksi harus sama dengan tanggal hari ini.");
				return false;
		}
		return true;
	}

}
