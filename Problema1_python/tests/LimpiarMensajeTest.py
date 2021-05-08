import unittest
import sys

sys.path.append("./app")

from Processor import Processor


class LimpiarMensajeTest(unittest.TestCase):
    def test_limpiar_mensaje_debe_eliminar_letras_iguales_consecutivas(self):
        pObj = Processor()
        responseTrue = pObj.limpiar_mensaje("holaaaaa")
        responseFalse = pObj.limpiar_mensaje("holaaaaasss")

        self.assertEqual("hola", responseTrue)
        self.assertNotEqual("hola", responseFalse)


if __name__ == "__main__":
    unittest.main()
