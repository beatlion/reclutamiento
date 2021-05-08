import unittest
import sys

sys.path.append("./app")

from Processor import Processor


class ValidarDatosExceptionTest(unittest.TestCase):
    def test_validar_datos_instrucciones_genera_exception_cuando_en_linea_1_parametro_1_no_coincida_con_texto_linea_2(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_datos(
                [
                    "5 14 80",
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
                "==>  test_validar_datos_instrucciones_genera_exception_cuando_en_linea_1_parametro_1_no_coincida_con_texto_linea_2"
            )

    def test_validar_datos_instrucciones_genera_exception_cuando_en_linea_1_parametro_2_no_coincida_con_texto_linea_3(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_datos(
                [
                    "11 20 80",
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
                "==>  test_validar_datos_instrucciones_genera_exception_cuando_en_linea_1_parametro_2_no_coincida_con_texto_linea_3"
            )

    def test_validar_datos_instrucciones_genera_exception_cuando_en_linea_1_parametro_3_no_coincida_con_texto_linea_4(
        self,
    ):
        try:
            PObj = Processor()
            response = PObj.validar_datos(
                [
                    "11 14 40",
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
                "==>  test_validar_datos_instrucciones_genera_exception_cuando_en_linea_1_parametro_3_no_coincida_con_texto_linea_4"
            )
