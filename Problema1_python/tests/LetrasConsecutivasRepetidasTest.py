import unittest
import sys

sys.path.append("./app")

from Processor import Processor


class LetrasConsecutivasRepetidasTest(unittest.TestCase):
    def test_letras_repetidas_verifica_si_el_texto_tienen_letras_consecutivas_repetidas(
        self,
    ):
        pObj = Processor()
        response1 = pObj.letras_consecutivas_repetidas("holaaaaa")
        response2 = pObj.letras_consecutivas_repetidas("hola")

        self.assertTrue(response1)
        self.assertFalse(response2)


# if __name__ == "__main__":
#     unittest.main()
