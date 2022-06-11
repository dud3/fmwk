with import <nixpkgs> {};

stdenv.mkDerivation {
  name = "fmwk";
  buildInputs = [
    php
  ];
  shellHook = ''
  '';
}
