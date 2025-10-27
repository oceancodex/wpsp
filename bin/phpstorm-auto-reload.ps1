# PHPStorm Auto Reload - Send Ctrl+Alt+Y
# Script này được gọi từ PHP command để trigger PHPStorm sync

Add-Type @"
    using System;
    using System.Runtime.InteropServices;
    using System.Diagnostics;
    using System.Text;

    public class Win32 {
        [DllImport("user32.dll")]
        public static extern IntPtr GetForegroundWindow();

        [DllImport("user32.dll")]
        public static extern bool SetForegroundWindow(IntPtr hWnd);

        [DllImport("user32.dll")]
        public static extern void keybd_event(byte bVk, byte bScan, uint dwFlags, UIntPtr dwExtraInfo);

        [DllImport("user32.dll", CharSet = CharSet.Auto)]
        public static extern int GetWindowText(IntPtr hWnd, StringBuilder lpString, int nMaxCount);

        public const byte VK_CONTROL = 0x11;
        public const byte VK_MENU = 0x12;    // Alt key
        public const byte VK_Y = 0x59;
        public const uint KEYEVENTF_KEYUP = 0x0002;
    }
"@

# Lưu window hiện tại
$currentWindow = [Win32]::GetForegroundWindow()

# Tìm PHPStorm process
$phpstormProcess = Get-Process | Where-Object {
    $_.ProcessName -match "phpstorm|idea64|webide" -and
    $_.MainWindowHandle -ne 0
} | Select-Object -First 1

if ($phpstormProcess) {
    $phpstormWindow = $phpstormProcess.MainWindowHandle

    # Lấy tên window để verify
    $windowTitle = New-Object System.Text.StringBuilder 256
    [Win32]::GetWindowText($phpstormWindow, $windowTitle, 256) | Out-Null

    Write-Host "[Sync] Found PHPStorm: $($windowTitle.ToString())" -ForegroundColor Cyan

    # Focus vào PHPStorm
    [Win32]::SetForegroundWindow($phpstormWindow) | Out-Null
#     Start-Sleep -Milliseconds 200

    # Gửi Ctrl+Alt+Y
    [Win32]::keybd_event([Win32]::VK_CONTROL, 0, 0, 0)
    [Win32]::keybd_event([Win32]::VK_MENU, 0, 0, 0)
#     Start-Sleep -Milliseconds 50
    [Win32]::keybd_event([Win32]::VK_Y, 0, 0, 0)
#     Start-Sleep -Milliseconds 50
    [Win32]::keybd_event([Win32]::VK_Y, 0, [Win32]::KEYEVENTF_KEYUP, 0)
    [Win32]::keybd_event([Win32]::VK_MENU, 0, [Win32]::KEYEVENTF_KEYUP, 0)
    [Win32]::keybd_event([Win32]::VK_CONTROL, 0, [Win32]::KEYEVENTF_KEYUP, 0)

#     Start-Sleep -Milliseconds 100

    # Quay lại window ban đầu (nếu khác PHPStorm)
    if ($currentWindow -ne $phpstormWindow) {
        [Win32]::SetForegroundWindow($currentWindow) | Out-Null
    }

    Write-Host "[Sync] Ctrl+Alt+Y sent successfully!" -ForegroundColor Green

} else {
    Write-Host "[Sync] PHPStorm window not found!" -ForegroundColor Yellow
    Write-Host "[Sync] Make sure PHPStorm is running and has a visible window." -ForegroundColor Yellow
}