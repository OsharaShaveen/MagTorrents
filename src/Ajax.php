<?php

namespace gabrielcarvalhogama\MagTorrents;

class Ajax
{

    function sanitizeString($str)
    {
        $str = preg_replace('/[áàãâä]/ui', 'a', $str);
        $str = preg_replace('/[éèêë]/ui', 'e', $str);
        $str = preg_replace('/[íìîï]/ui', 'i', $str);
        $str = preg_replace('/[óòõôö]/ui', 'o', $str);
        $str = preg_replace('/[úùûü]/ui', 'u', $str);
        $str = preg_replace('/[ç]/ui', 'c', $str);
        // $str = preg_replace('/[,(),;:|!"#$%&/=?~^><ªº-]/', '_', $str);
        $str = preg_replace('/[^a-z0-9]/i', '-', $str);
        $str = preg_replace('/_+/', '-', $str); // ideia do Bacco :)
        return strtolower($str);
    }

    function startsWith($haystack, $needle)
    {
        // search backwards starting from haystack length characters from the end
        return $needle === "" || strrpos($haystack, $needle, -strlen($haystack)) !== false;
    }

}

$db = new DB;
$typeRequest = addslashes(strip_tags($_POST['typeRequest']));
switch ($typeRequest) {
    case "pagination":
        $load = htmlentities(strip_tags($_POST['load']));
        $sql = $db->con()->prepare("SELECT id_post, title, link, sinopse, poster, category, duration, year, size, quality FROM mt_posts ORDER BY id_post DESC LIMIT " . $load . ", 10");
        $sql->execute();
        while ($ftc = $sql->fetchObject()) {
            echo "<a href='movies/$ftc->link'>",
            "<div class='item'>",
            "<img src='$ftc->poster' />",
            "<div class='info'>",
            "<h1>$ftc->title</h1>",
            "</div>",
            "</div>",
            "</a>";
        }

        break;
    case
    "loginAdm":
        $password = (isset($_POST['password'])) ? addslashes(strip_tags($_POST['password'])) : "";
        if (empty($password)):
            return "Preencha todos os campos!";
        else:
            if ($password == PASSWORDPANEL):
                session_start();
                $_SESSION['passwordPanel'] = PASSWORDPANEL;
                $_SESSION['IPOrigin'] = $_SERVER['REMOTE_ADDR'];
                echo 1;
            else:
                echo "Palavra-passe errada!";
            endif;
        endif;
        break;
    case "newMovie":

        $title = (isset($_POST['title']) AND !empty($_POST['title'])) ? addslashes(strip_tags($_POST['title'])) : "";
        $sinopse = (isset($_POST['sinopse']) AND !empty($_POST['sinopse'])) ? addslashes(strip_tags($_POST['sinopse'])) : "";
        $poster = (isset($_POST['poster']) AND !empty($_POST['poster'])) ? addslashes(strip_tags($_POST['poster'])) : "";
        $categories = (isset($_POST['categories']) AND !empty($_POST['categories'])) ? addslashes(strip_tags($_POST['categories'])) : "";
        $duration = (isset($_POST['duration']) AND !empty($_POST['duration'])) ? addslashes(strip_tags($_POST['duration'])) : "";
        $year = (isset($_POST['year']) AND !empty($_POST['year'])) ? addslashes(strip_tags($_POST['year'])) : "";
        $director = (isset($_POST['director']) AND !empty($_POST['director'])) ? addslashes(strip_tags($_POST['director'])) : "";
        $size = (isset($_POST['size']) AND !empty($_POST['size'])) ? addslashes(strip_tags($_POST['size'])) : "";
        $imdb = (isset($_POST['imdb']) AND !empty($_POST['imdb'])) ? addslashes(strip_tags($_POST['imdb'])) : "";
        $quality = (isset($_POST['quality']) AND !empty($_POST['quality'])) ? addslashes(strip_tags($_POST['quality'])) : "";
        $qualityAudio = (isset($_POST['qualityAudio']) AND !empty($_POST['qualityAudio'])) ? addslashes(strip_tags($_POST['qualityAudio'])) : "";
        $qualityVideo = (isset($_POST['qualityVideo']) AND !empty($_POST['qualityVideo'])) ? addslashes(strip_tags($_POST['qualityVideo'])) : "";
        $urlDownload = (isset($_POST['urlDownload']) AND count($_POST['urlDownload']) > 0) ? $_POST['urlDownload'] : "";
        $legendUrl = (isset($_POST['legendUrl']) AND !empty($_POST['legendUrl'])) ? addslashes(strip_tags($_POST['legendUrl'])) : [];

        if (
            empty($title)
            OR empty($sinopse)
            OR empty($poster)
            OR empty($categories)
            OR empty($duration)
            OR empty($year)
            OR empty($director)
            OR empty($size)
            OR empty($imdb)
            OR empty($quality)
            OR empty($qualityAudio)
            OR empty($qualityVideo)
        ) {
            echo "Preencha todos os campos!";
        } else {
            $link = sanitizeString($title);
            $duration = date("h:m:s", ((int)$duration * 60));
            $sqlC = $db->con()->prepare("SELECT link FROM mt_posts WHERE link = :link");
            $sqlC->bindValue("link", $link);
            $sqlC->execute();
            if ($sqlC->rowCount() > 0) {
                $link = $link . rand(1, 100);
            }
            $sql = $db->con()->prepare("INSERT INTO mt_posts
          (title, link, sinopse, poster, category, duration, year, director, size, imdb, quality, quality_video, quality_audio, type) VALUES
          (:title, :link, :sinopse, :poster, :category, :duration, :year, :director, :size, :imdb, :quality, :qualityVideo, :qualityAudio, :type)");
            $sql->bindValue("title", $title);
            $sql->bindValue("link", $link);
            $sql->bindValue("sinopse", $sinopse);
            $sql->bindValue("poster", $poster);
            $sql->bindValue("category", $categories);
            $sql->bindValue("duration", $duration);
            $sql->bindValue("year", $year);
            $sql->bindValue("director", $director);
            $sql->bindValue("size", $size);
            $sql->bindValue("imdb", $imdb);
            $sql->bindValue("quality", $quality);
            $sql->bindValue("qualityVideo", $qualityVideo);
            $sql->bindValue("qualityAudio", $qualityAudio);
            $sql->bindValue("type", 0);
            if ($sql->execute()) {
                $sqlL = $db->con()->prepare("SELECT id_post, link FROM mt_posts WHERE link = :link LIMIT 1");
                $sqlL->bindValue("link", $link);
                $sqlL->execute();
                $ftcL = $sqlL->fetchObject();
                $id = $ftcL->id_post;

                if (!empty($legendUrl)):
                    $sql = $db->con()->prepare("INSERT INTO mt_links (link, post, type_link) VALUES (:link, :post, :type_link)");
                    $sql->bindValue("link", $legendUrl);
                    $sql->bindValue("post", $id);
                    $sql->bindValue("type_link", 3);
                    $sql->execute();
                endif;

                for ($i = 0; $i < count($urlDownload); $i++) {
                    if (empty($urlDownload[$i])) {
                        echo "URL para download <strong>do filme</strong> inválida";
                    } else {
                        $sql = $db->con()->prepare("INSERT INTO mt_links (link, post, type_link) VALUES (:link, :post, :type_link)");
                        $sql->bindValue("link", $urlDownload[$i]);
                        $sql->bindValue("post", $id);
                        if (substr($urlDownload[$i], 0, 6) == "magnet"):
                            $sql->bindValue("type_link", 2);
                        else:
                            $sql->bindValue("type_link", 1);
                        endif;
                        $sql->execute();
                    }
                }
                echo 1;
            } else {
                echo "Erro ao adicionar o filme.";
            }
        }

        break;
    default:

        break;
}