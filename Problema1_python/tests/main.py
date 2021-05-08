import unittest
import sys

sys.path.append("./")


""" se importan todas las clases de los test """
from GenerarMensajeTest import *
from LetrasConsecutivasRepetidasTest import *
from LimpiarMensajeTest import *
from ValidarDatosExceptionTest import *
from ValidarInstruccionesExceptionTest import *

""" se ejecutan los test´s"""
if __name__ == "__main__":
    unittest.main()
