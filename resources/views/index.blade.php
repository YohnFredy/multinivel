<x-app-layout>
    <style>
        .posicion {
            top: 20%;
            right: 5%;
        }

        @media (min-width: 768px) {
            .posicion {
                top: 30%;
                right: 5%;
            }
        }

        @media (min-width: 1280px) {
            .posicion {
                top: 40%;
                right: 10%;
            }
        }
    </style>
    <div class="relative">
        <img class=" w-full shadow-md" src="{{ asset('storage\images\1682656345.jpg') }}" alt="">
        <div class="absolute posicion ">
            <div class=" text-center text-palette-100 text-xl md:text-3xl lg:text-4xl">
                <p>La mejor manera de crecer</p>
                <p class=" flex items-center justify-center">
                    <Strong>App</Strong>
                    <span class="  font-semibold">Plus</span>
                    <i class="fas fa-chevron-right text-sm md:text-lg lg:text-2xl ml-2"></i>
                    <i class="fas fa-chevron-right text-sm md:text-lg lg:text-2xl"></i>
                </p>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-6 ">

        <div class=" grid grid-cols-5 gap-x-4 lg:gap-x-10 xl:gap-x-20 gap-y-6 mt-8 ">

            <div class=" col-span-5 md:col-span-3 flex items-center ">

                <div>
                    <p class=" text-xl font-bold text-center text-palette-200">Todo en una plataforma. </p>

                    <p class="text-justify mt-4">
                        AppPlus es una plataforma que reúne diferentes aplicaciones, ofreciendo una experiencia de
                        usuario única y completa. Al unirse a la comunidad de AppPlus, se tiene la posibilidad de
                        acceder a todas las aplicaciones que se encuentran en la plataforma, lo que resulta en una
                        oferta amplia y diversa de servicios. <br><br>

                        La comunidad de AppPlus está en constante crecimiento a nivel mundial, lo que significa que se
                        pueden conectar con personas de diferentes partes del mundo y conocer nuevas aplicaciones y
                        servicios. Pero lo más importante es que todas las aplicaciones que se conectan a la plataforma
                        de AppPlus, son cuidadosamente seleccionadas y ofrecen un excelente servicio, lo que resulta en
                        grandes ganancias para la comunidad. <br><br>

                        Al utilizar los servicios de AppPlus, se tiene la garantía de contar con un servicio seguro,
                        fácil de utilizar y con una atención de primera. Cada usuario es importante para la comunidad de
                        AppPlus y se asegura que se sientan cómodos y satisfechos con los servicios ofrecidos.
                    </p>
                </div>
            </div>
            <div class=" flex items-center col-span-5 md:col-span-2">
                <img class=" rounded-md shadow-md"
                    src="https://acnews.blob.core.windows.net/imgnews/large/NAZ_43e8b0a1269e4e769bec1761e0b8f97a.jpg"
                    alt="">
            </div>
            <p class=" col-span-5  text-center">
                AppPlus es una plataforma que ofrece una experiencia completa para los usuarios al
                reunir diferentes aplicaciones en un solo lugar. Al unirse a la comunidad de AppPlus, se puede
                acceder a una oferta amplia y diversa de servicios, todos cuidadosamente seleccionados para
                ofrecer un excelente servicio y grandes ganancias a la comunidad. Además, se tiene la garantía
                de contar con un servicio seguro, fácil de utilizar y con una atención de primera.
            </p>
        </div>

        <div class=" grid grid-cols-4 gap-6 md:gap-x-10 lg:gap-3 xl:gap-4 mt-8 md:mt-12">

            <p class=" col-span-4 text-2xl font-bold text-palette-200 text-center md:mb-4">Diferentes servicios. </p>
            <div class=" col-span-4 md:col-span-2 lg:col-span-1 bg-palette-200 rounded-md shadow-md">
                <img class=" rounded-t-md"
                    src="https://www.cootracerrejon.coop/wp-content/uploads/2021/12/beneficios-economia-solidaria.jpg"
                    alt="">
                <div class="py-6 px-4">
                    <p class=" text-center text-palette-100 font-bold text-lg">
                        Economía Solidaria
                    </p>
                    <p class=" text-center text-palette-100 mt-4">
                        Únete al club ganador y crea una fuente de trabajo de manera práctica.
                        Participa en los
                        sorteos que se realizan constantemente.
                    </p>
                </div>
            </div>

            <div class=" col-span-4 md:col-span-2 lg:col-span-1 bg-palette-300 rounded-md shadow-md">
                <img class=" rounded-t-md"
                    src="https://img.freepik.com/foto-gratis/hombre-pie-asiento-conductor-telefono_23-2148693729.jpg?w=740&t=st=1671725607~exp=1671726207~hmac=1e48071b05458e7c25cf7b492e74f666d7fc8b6502ce416768badd38bc11ec4c"
                    alt="">
                <div class="py-6 px-4">
                    <p class=" text-center text-palette-100 font-bold text-lg">
                        Transporte
                    </p>
                    <p class=" text-center text-palette-100 mt-4">
                        Con nuestro servicio de transporte tendrás: Tarifas justas, seguridad, comodidad, rapidez,
                        soporte 24/7.
                    </p>
                </div>
            </div>

            <div class="col-span-4 md:col-span-2 lg:col-span-1 bg-palette-400 rounded-md shadow-md">
                <img class=" rounded-t-md"
                    src="https://img.freepik.com/fotos-premium/vista-frontal-par-manos-sosteniendo-bolsa-papel_23-2148382368.jpg?w=740"
                    alt="">
                <div class="py-6 px-4">
                    <p class=" text-center text-palette-100 font-bold text-lg">
                        Domicilios
                    </p>
                    <p class=" text-center text-palette-100 mt-4">
                        Servicio rápido y de calidad con opciones y promociones continuas a través de nuestros aliados
                        en restaurantes, droguerías y almacenes, entre otros.
                    </p>
                </div>
            </div>
            <div class="col-span-4 md:col-span-2 lg:col-span-1 bg-palette-500 rounded-md shadow-md">
                <img class=" rounded-t-md"
                    src="https://img.freepik.com/fotos-premium/paquetes-productos-bolsa-compra-carrito-portatil-concepto-compras-entrega_38716-138.jpg?w=740"
                    alt="">
                <div class="py-6 px-4">
                    <p class=" text-center text-palette-100  font-bold text-lg">
                        Tienda
                    </p>
                    <p class=" text-center text-palette-100 ">

                        Con nuestra tienda en línea, podrás disfrutar de la comodidad de recibir una amplia variedad de
                        productos. Precios justos y promociones atractivas, garantizando siempre la calidad y
                        satisfacción de nuestros clientes.
                    </p>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>

   