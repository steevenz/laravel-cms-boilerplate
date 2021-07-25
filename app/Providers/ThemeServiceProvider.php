<?php


namespace App\Providers;


use Illuminate\Support\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public static function serveAsset($filePath)
    {
        $filePath = str_replace(['\\','/'], DIRECTORY_SEPARATOR, resource_path($filePath));

        if(file_exists($filePath)) {
            $fileStat = stat($filePath);
            $filePathInfo = pathinfo($filePath);
            $filePathInfo['mime'] = finfo_file(finfo_open(FILEINFO_MIME_TYPE), $filePath);
            $filePathInfo['size'] = $fileStat[7];
            $filePathInfo['mtime'] = $fileStat[9];

            if(in_array($filePathInfo['extension'], ['json', 'txt', 'xml', 'js', 'css'])) {
                header('Content-Disposition: filename=' . $filePathInfo['filename'] . '.' . $filePathInfo['extension']);
                header('Content-Transfer-Encoding: binary');
                header('Last-Modified: ' . gmdate('D, d M Y H:i:s', time()) . ' GMT');
                header('Content-Type: ' . $filePathInfo['mime']);
                echo file_get_contents($filePath);
                exit;
            } else {
                $fileChunkSize = 1024 * 1024;
                $lengthStart = 0;
                $lengthEnd = $filePathInfo['size'];

                if ($httpRange = $_SERVER['HTTP_RANGE']) {
                    if (preg_match('/bytes=\h*(\d+)-(\d*)[\D.*]?/i', $httpRange, $matches)) {
                        $lengthStart = intval($matches[0]);
                        if (!empty($matches[1])) {
                            $lengthEnd = intval($matches[1]);
                        }
                    }
                }

                if ($lengthStart > 0 || $lengthEnd < $filePathInfo['size']) {
                    header('HTTP/1.0 206 Partial Content');
                } else {
                    header('HTTP/1.0 200 OK');
                }

                header('Content-Type: ' . $filePathInfo['mime']);
                header('Cache-Control: max-age=60');
                header('Content-Length:' . ($lengthEnd - $lengthStart));
                header("Content-Range: bytes " . ($lengthStart - $lengthEnd) / $fileStat['size']);
                header("Content-Disposition: inline; filename=" . $filePathInfo['filename'] . '.' . $filePathInfo['extension']);
                header("Content-Transfer-Encoding: binary\n");
                header("Last-Modified: " . gmdate('D, d M Y H:i:s', $filePathInfo['mtime']) . ' GMT');
                header('Connection: close');

                $lengthCurrent = $lengthStart;
                $fileHandle = fopen($filePath);
                fseek($fileHandle, $lengthStart, 0);

                $buffer = '';
                ob_start();
                while (!feof($fileHandle) && $lengthCurrent < $lengthEnd && (connection_status() == 0)) {
                    echo fread($fileHandle, min($fileChunkSize, $lengthEnd - $lengthCurrent));
                    $lengthCurrent += $fileChunkSize;
                    $buffer .= ob_get_contents();

                    ob_end_flush();
                }

                echo $buffer;
                exit;
            }
        } else {
            abort(404);
        }
    }
}
