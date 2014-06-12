;#Include <GuiMonthCal.au3> ; $tagSYSTEMTIME is defined in here.
Local $hWnd = WinActivate("PC-Radio 6")
Send("!bop")
;MouseMove(640, 512)
Local $reshifts = $CmdLine[1]
If $reshifts < 0 Then
   Do
	  $reshifts = $reshifts + 1;
	  Send("{PGUP}")
   Until $reshifts = 0
ElseIf $reshifts > 0 Then
   Do
	  $reshifts = $reshifts - 1;
	  Send("{PGDN}")
   Until $reshifts = 0
EndIf

Send("{HOME}")

Local $dateLine = $CmdLine[2]
If $dateLine > 0 Then
   Do
	  Send("!{RIGHT}")
	  $dateLine = $dateLine - 1;
   Until $dateLine = 0
EndIf

Send("{ENTER}")

;Send("!bh{UP}{ENTER}")
;Local $closeHandle = WinWaitActive("[CLASS:Notepad]")
;WinClose($closeHandle)