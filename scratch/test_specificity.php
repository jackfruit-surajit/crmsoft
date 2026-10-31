<?php
// Let's test the specificity of .admin #wrapper a:hover vs .btn-primary:hover
echo "When hovering over <a href='...' class='btn btn-primary'>New Customer</a>:\n";
echo "Rule 1: .btn-primary:hover { color: #000000 !important; }\n";
echo "Rule 2: .admin #wrapper a:hover { color: #ffd700 !important; }\n";
echo "Specificity of (.admin #wrapper a:hover) is: 1 ID, 1 CLASS, 1 TAG, 1 PSEUDO = (1, 1, 2)!\n";
echo "Specificity of (.btn-primary:hover) is: 0 ID, 1 CLASS, 0 TAG, 1 PSEUDO = (0, 1, 1)!\n";
echo "\nRESULT: .admin #wrapper a:hover WINS because of the #wrapper ID selector and !important!\n";
echo "Therefore, every <a class='btn'> in the admin panel has its text turned gold (#ffd700) on hover!\n";

