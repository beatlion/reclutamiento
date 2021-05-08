import unittest
import sys

sys.path.append("./app")

from Processor import Processor


class GenerarMensajeTest(unittest.TestCase):
    def test_generar_mensaje_corectamente(
        self,
    ):
        P_Obj = Processor()
        response = P_Obj.generar_mensaje(
            [
                "11 14 38",
                "CeseAlFuego",
                "CoranACubierto",
                "XXcaaamakkCCessseAAllFueeegooDLLKmmNNN",
            ]
        )

        self.assertEqual("Si\nNo", response)

    def test_generar_mensaje_genera_un_exception_por_recibir_dos_mensajes_posibles(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.generar_mensaje(
                [
                    "11 14 80",
                    "CeseAlFuego",
                    "CoranACubierto",
                    "XXcaaamakkCCessseAAllFueeegooCoranACuuubiiiertoooDLLKmmNNN",
                ]
            )

        except ValueError as e:
            # print(e)
            pass
        else:
            raise ValueError(
                "==>  test_generar_mensaje_genera_un_exception_por_recibir_dos_mensajes_posibles"
            )


if __name__ == "__main__":
    unittest.main()
