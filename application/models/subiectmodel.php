<?php

require 'public/libs/cloudinary-api/Cloudinary.php';
require 'public/libs/cloudinary-api/Uploader.php';
require 'public/libs/cloudinary-api/Helpers.php';
require 'public/libs/cloudinary-api/Api.php';

\Cloudinary::config(array(
  'cloud_name' => 'dofw0qkgd',
  'api_key' => '499923913519826',
  'api_secret' => 'TGmDDwUZLNjofbx5MI7nnAO7J9o'
));

class SubiectModel {

  // Database
  function __construct($db) {
    try {
      $this->db = $db;
    } catch (PDOException $e) {
      exit('Database connection could not be established.');
    }
  }

  // Search Subiecte
  public function searchSubiecte($specializare_id, $anul, $semestrul, $materie_id) {
    if(!empty($specializare_id)) {
      $specializare_id = strip_tags($specializare_id);

      if(!empty($anul)) {
        $anul = strip_tags($anul);

        if(!empty($semestrul)) {
          $semestrul = strip_tags($semestrul);

          if(!empty($materie_id)) {
            $materie_id = strip_tags($materie_id);

            $sql = 'SELECT * FROM arhiva_ulbs_subiecte WHERE specializare_id = :specializare_id AND anul = :anul AND semestrul = :semestrul AND materie_id = :materie_id';
            $query = $this->db->prepare($sql);
            $query->execute(array(':specializare_id' => $specializare_id, ':anul' => $anul, ':semestrul' => $semestrul, ':materie_id' => $materie_id));

            return $query->fetchAll();
          } else {
            $sql = 'SELECT * FROM arhiva_ulbs_subiecte WHERE specializare_id = :specializare_id AND anul = :anul AND semestrul = :semestrul';
            $query = $this->db->prepare($sql);
            $query->execute(array(':specializare_id' => $specializare_id, ':anul' => $anul, ':semestrul' => $semestrul));

            return $query->fetchAll();
          }
        } else {
          $sql = 'SELECT * FROM arhiva_ulbs_subiecte WHERE specializare_id = :specializare_id AND anul = :anul';
          $query = $this->db->prepare($sql);
          $query->execute(array(':specializare_id' => $specializare_id, ':anul' => $anul));

          return $query->fetchAll();
        }
      } else {
        $sql = 'SELECT * FROM arhiva_ulbs_subiecte WHERE specializare_id = :specializare_id';
        $query = $this->db->prepare($sql);
        $query->execute(array(':specializare_id' => $specializare_id));

        return $query->fetchAll();
      }
    } else {
      return null;
    }
  }

  // Get Subiect Data
  public function getSubiectData($slug) {
    $slug = strip_tags($slug);

    $sql = 'SELECT * FROM arhiva_ulbs_subiecte WHERE slug = :subiect_slug';
    $query = $this->db->prepare($sql);
    $query->execute(array(':subiect_slug' => $slug));

    return $query->fetch();
  }

  // Get Subiecte
  public function getSubiecte() {
    $sql = 'SELECT * FROM arhiva_ulbs_subiecte';
    $query = $this->db->prepare($sql);
    $query->execute();

    return $query->fetchAll();
  }

  // Get Materie Data
  public function getMaterieData($materie_id) {
    $materie_id = strip_tags($materie_id);

    $sql = 'SELECT * FROM arhiva_ulbs_materii WHERE id = :materie_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':materie_id' => $materie_id));

    return $query->fetch();
  }

  // Get Account Data
  public function getAccountData($account_id) {
    $account_id = strip_tags($account_id);

    $sql = 'SELECT username FROM arhiva_ulbs_accounts WHERE id = :account_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':account_id' => $account_id));

    return $query->fetch();
  }

  // Format Subiect Time
  public function formatSubiectTime($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
      'y' => array('ani', 'an'),
      'm' => array('luni', 'lună'),
      'w' => array('săptămâni', 'săptămână'),
      'd' => array('zile', 'zi'),
      'h' => array('ore', 'oră'),
      'i' => array('minute', 'minut'),
      's' => array('secunde', 'secundă')
    );
    foreach($string as $k => &$v) {
      if($diff->$k) {
        $v = $diff->$k . ' ' . ($diff->$k > 1 ? $v[0] : $v[1]);
      } else {
        unset($string[$k]);
      }
    }

    if(!$full) $string = array_slice($string, 0, 1);
    return $string ? 'acum ' . implode(', ', $string) : 'acum câteva secunde';
  }

  // Get Materii
  public function getMaterii($specializare_id, $anul, $semestrul) {
    $specializare_id = strip_tags($specializare_id);
    $anul = strip_tags($anul);
    $semestrul = strip_tags($semestrul);

    $sql = 'SELECT * FROM arhiva_ulbs_materii WHERE specializare_id = :specializare_id AND anul = :anul AND semestrul = :semestrul';
    $query = $this->db->prepare($sql);
    $query->execute(array(':specializare_id' => $specializare_id, ':anul' => $anul, ':semestrul' => $semestrul));

    return $query->fetchAll();
  }

  // Post Subiect
  public function postSubiect($account_id, $specializare_id, $materie_id, $anul, $semestrul, $description, $subiect_image) {
    if(!empty($specializare_id) && !empty($materie_id) && !empty($anul) && !empty($semestrul) && !empty($description)) {
      $specializare_id = strip_tags($specializare_id);
      $materie_id = strip_tags($materie_id);
      $anul = strip_tags($anul);
      $semestrul = strip_tags($semestrul);
      $description = strip_tags($description);
      $today = time();
      $date_time = date('Y-m-d H:i:s', $today);

      $sql_materie = 'SELECT * FROM arhiva_ulbs_materii WHERE id = :materie_id';
      $query_materie = $this->db->prepare($sql_materie);
      $query_materie->execute(array(':materie_id' => $materie_id));

      $materie = $query_materie->fetch();

      if($materie) {
        $slug = 'subiect-la-' . $materie->slug . '-anul-' . $anul . '-semestrul-' . $semestrul . '-' . $today;

        $upload_image = \Cloudinary\Uploader::upload($subiect_image['tmp_name'], array('public_id' => $slug, 'folder' => 'arhiva-ulbs/subiecte'));
        if($upload_image) {
          $sql = 'INSERT INTO arhiva_ulbs_subiecte (account_id, specializare_id, materie_id, anul, semestrul, date_time, slug, description, image, visible) VALUES (:account_id, :specializare_id, :materie_id, :anul, :semestrul, :date_time, :slug, :description, :image, :visible)';
          $query = $this->db->prepare($sql);
          $query->execute(
            array(
              ':account_id' => $account_id,
              ':image' => $upload_image['url'],
              ':specializare_id' => $specializare_id,
              ':slug' => $slug,
              ':materie_id' => $materie_id,
              ':anul' => $anul,
              ':semestrul' => $semestrul,
              ':date_time' => $date_time,
              ':description' => $description,
              ':visible' => 1
            )
          );

          return array(
            'slug' => $slug
          );
        } else {
          return array(
            'error' => 'Ceva nu a funcționat la încărcarea imaginii. Contactează echipa de suport.'
          );
        }
      } else {
        return array(
          'error' => 'Materia introdusă este invalidă.'
        );
      }
    } else {
      return array(
        'error' => 'Te rugăm să completezi toate câmpurile.'
      );
    }
  }

  // Get Subiect Thanks
  public function getSubiectThanks($subiect_id) {
    $subiect_id = strip_tags($subiect_id);

    $sql = 'SELECT * FROM arhiva_ulbs_subiecte_thanks WHERE subiect_id = :subiect_id';
    $query = $this->db->prepare($sql);
    $query->execute(array(':subiect_id' => $subiect_id));

    return $query->fetchAll();
  }

  // Subiect Thanked
  public function subiectThanked($account_id, $subiect_id) {
    $account_id = strip_tags($account_id);
    $subiect_id = strip_tags($subiect_id);

    $sql_check = 'SELECT COUNT(id) AS subiect_thanks_by_account FROM arhiva_ulbs_subiecte_thanks WHERE account_id = :account_id AND subiect_id = :subiect_id';
    $query_check = $this->db->prepare($sql_check);
    $query_check->execute(array(':account_id' => $account_id, ':subiect_id' => $subiect_id));
    $result = $query_check->fetch()->subiect_thanks_by_account;

    if($result == 0) {
      return false;
    } else {
      return true;
    }
  }

  // Thank Subiect
  public function thankSubiect($account_id, $subiect_id) {
    $account_id = strip_tags($account_id);
    $subiect_id = strip_tags($subiect_id);

    $subiect_thanked = $this->subiectThanked($account_id, $subiect_id);

    if($subiect_thanked == false) {
      $sql = 'INSERT INTO arhiva_ulbs_subiecte_thanks (account_id, subiect_id) VALUES (:account_id, :subiect_id)';
      $query = $this->db->prepare($sql);
      $query->execute(array(':account_id' => $account_id, ':subiect_id' => $subiect_id));

      return true;
    } else {
      return false;
    }
  }

  // Report Subiect
  public function reportSubiect($account_id, $subiect_id, $motiv, $details) {
    if(!empty($subiect_id) && !empty($motiv) && !empty($details)) {
      $account_id = strip_tags($account_id);
      $subiect_id = strip_tags($subiect_id);
      $motiv = strip_tags($motiv);
      $details = strip_tags($details);

      $sql_subiect = 'SELECT * FROM arhiva_ulbs_subiecte WHERE id = :subiect_id';
      $query_subiect = $this->db->prepare($sql_subiect);
      $query_subiect->execute(array(':subiect_id' => $subiect_id));
      $subiect = $query_subiect->fetch();

      if($subiect) {
        $sql = 'INSERT INTO arhiva_ulbs_subiecte_reports (account_id, subiect_id, motiv, details) VALUES (:account_id, :subiect_id, :motiv, :details)';
        $query = $this->db->prepare($sql);
        $query->execute(array(':account_id' => $account_id, ':subiect_id' => $subiect_id, ':motiv' => $motiv, ':details' => $details));

        return array(
          'slug' => $subiect->slug,
          'success' => 'Subiectul a fost raportat.'
        );
      } else {
        return array(
          'error' => 'Acest subiect nu există.'
        );
      }
    } else {
      return array(
        'error' => 'Te rugăm să completezi toate câmpurile.'
      );
    }
  }

}

?>
