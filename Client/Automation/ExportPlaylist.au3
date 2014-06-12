Local $hWnd = WinActivate("PC-Radio 6")
Send("!bh{ENTER}")
Local $closeHandle = WinWaitActive("[CLASS:Notepad]")
WinClose($closeHandle)