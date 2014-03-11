<?php 
	class Messages
	{
		private $id_em;
		private $id_dest;
		private $msg;
		
		function __construct($idEm=0,$idDst=0,$mes='')
		{
			$this->id_em=$idEm;
			$this->id_dest=$idDst;
			$this->msg=$mes;
		}

		public function send($db)
		{
			$var = array(
				'id_send' => (int) $this->id_em,
				'id_rec'  => (int) $this->id_dest,
				'msg'     => injection($this->msg),
			);
			
			$req = $db->prepare("INSERT INTO messages (id_send, id_rec, msg) VALUE (:id_send, :id_rec, :msg)");
			$req->execute($var);
		}

		public function get($p,$DB)
		{
			if (isset($p)) {
				extract($p);
				if ($id_em AND $id_rec) {
					session_start();
					$id_recc=(int) $id_rec;
					$var = array(
						'id_em'  => (int) $id_em,
						'id_rec' => (int) $id_rec
					);
					
					$sql = $DB->prepare("SELECT date_connect AS dc FROM users WHERE id=:id_em or id=:id_rec ORDER BY date_connect ASC limit 1");
					$sql->execute($var);
					$nr=$sql->rowCount();
					if ($nr>0) {
						$data=$sql->fetch(PDO::FETCH_ASSOC);
						extract($data);
						$sql=NULL;

						$var['dc'] = $dc;
						
						$sql = $DB->prepare("SELECT * FROM messages WHERE ((id_send=:id_em AND id_rec=:id_rec) OR (id_send=:id_rec AND id_rec=:id_em)) AND date>=:dc");
						$sql->execute($var);
						$nr=$sql->rowCount();
						if ($nr>0) {
							while ( $data=$sql->fetch(PDO::FETCH_ASSOC)) {
								extract($data);
								if ($id_send==$id_em) {
									?>
										<span id="cmsg">
											<img src="photos/<?php echo $id_em.'/'.$_SESSION['image_em']; ?>"  class="img-circle">
											<span class="label label-default" id="em">
												<?php echo $msg?>
											</span>
										</span>
										<div class="monclear"></div>
									<?php
								}else{
									?>
										<span id="cmsg" class="rec">
											<img src="photos/<?php echo $id_recc.'/'.$_SESSION['image_rec']; ?>"  class="img-circle rec">
											<span class="label label-info" id="rec">
												<?php echo $msg?>
											</span>
										</span>
										<div class="monclear"></div>
									<?php
								}
							}
						}
					}
				}
			}
		}
	}

