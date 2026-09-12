<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// --- STARTUP TEXT BANNER ---
echo "=========================================================\n";
echo "▛▀▖▌  ▛▀▖         ▜         ▌ \n";
echo "▙▄▘▛▀▖▌ ▌▞▀▖▛▀▖▞▀▖▐ ▞▀▖▝▀▖▞▀▌ \n";
echo "▌  ▌ ▌▌ ▌▌ ▌▌ ▌▛▀ ▐ ▌ ▌▞▀▌▌ ▌ \n";
echo "▘  ▘ ▘▀▀ ▝▀ ▘ ▘▝▀▘ ▘▝▀ ▝▀▘▝▀▘ \n";
echo "=========================================================\n";
echo " ▶ NETWORK SECURITY BYPASS & BRUTE-FORCE ENGINE          \n";
echo "=========================================================\n\n";

if (!extension_loaded('curl')) {
    die("❌ Error: The cURL extension is not enabled.\n");
}

$code = "TZ"; 
$maxCuts = 75; 

for ($i = 1; $i <= $maxCuts; $i++) {
    $num = str_pad($i, 2, "0", STR_PAD_LEFT);
    $targetFile = $code . "-" . $num . ".mp3";
    $absoluteUrl = "https://www.jingles.com/audio/mp3/" . $code . "/" . $targetFile;
    
    echo "🔍 Testing: " . $targetFile . " ... ";

    // Initialize Network Check Configured to Bypass Firewalls/SSL Errors
    $ch = curl_init($absoluteUrl);
    curl_setopt($ch, CURLOPT_NOBODY, true); // Head Request Only
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
    curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    
    // 🛡️ SECURITY & SSL DISABLERS (Fixes HTTP 0)
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    
    // 🖥️ FULL BROWSER SIMULATION HEADERS
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,*/*;q=0.8',
        'Accept-Language: en-US,en;q=0.5',
        'Connection: keep-alive'
    ]);

    curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    
    // Capture details if network breaks entirely
    if ($httpCode === 0) {
        $curlError = curl_error($ch);
        echo "🚨 Connection Blocked: " . (!empty($curlError) ? $curlError : "Empty handshaking return") . "\n";
        curl_close($ch);
        continue;
    }

    if ($httpCode === 200) {
        echo "✨ FOUND! Downloading ... ";
        
        $dl = curl_init($absoluteUrl);
        curl_setopt($dl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($dl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($dl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($dl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($dl, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
        
        $audioData = curl_exec($dl);
        curl_close($dl);

        if (!empty($audioData)) {
            file_put_contents($targetFile, $audioData);
            echo "✅ Saved!\n";
        } else {
            echo "❌ File system write failed\n";
        }
    } else {
        echo "⏭️ Not found (HTTP " . $httpCode . ")\n";
    }
}

echo "\n=========================================================\n";
echo " ✨ Complete! Check your sidebar repository for downloads.\n";
echo "=========================================================\n";
?>