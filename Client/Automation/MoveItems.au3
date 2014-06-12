Local $hWnd = WinActivate("PC-Radio 6")
Local $i = $CmdLine[2]
Local $direction = $CmdLine[1]
If $direction = "up" Then
   Do
	  ;MsgBox("", "", "The value of $i is: " & $i) ; Display the value of $i.
	  Send("{UP}")
	  $i = $i - 1 ; Or $i += 1 can be used as well.
	  Until $i = 0 ; Increase the value of $i until it equals the value of 10.
   ElseIf $direction = "down" Then
   Do
	  ;MsgBox($MB_SYSTEMMODAL, "", "The value of $i is: " & $i) ; Display the value of $i.
	  Send("{DOWN}")
	  $i = $i - 1 ; Or $i += 1 can be used as well.
	  Until $i = 0 ; Increase the value of $i until it equals the value of 10.
EndIf