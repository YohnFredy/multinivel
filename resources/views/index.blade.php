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
                    <span class="elephant-text text-2xl font-semibold">FORNUVI</span>
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
                    <p class=" text-xl font-bold text-center text-palette-200">Salud y Solidaridad: Un Camino hacia el
                        Bienestar Colectivo a través de Productos Naturales </p>

                    <p class="text-justify mt-4">

                        La salud es uno de los aspectos más importantes de la vida. Mantener un cuerpo y mente
                        saludables no solo nos permite disfrutar más plenamente de nuestras actividades diarias, sino
                        que también nos proporciona bienestar a largo plazo. Adoptar un estilo de vida saludable, basado
                        en productos naturales, es una forma efectiva de cuidar de nosotros mismos de manera sostenible.
                        Los productos naturales no solo benefician a nuestro organismo, sino que respetan el equilibrio
                        con el entorno, evitando el uso de sustancias. <br><br>

                        Cuidar nuestra salud a través de estos productos puede ir más allá de un beneficio personal,
                        convirtiéndose en una acción solidaria. Imagínate ser parte de una comunidad donde cada compra
                        no solo mejora tu bienestar, sino que también ayuda a otros. A través de un sistema
                        colaborativo, cada comisión generada por las ventas se dirige a una bolsa global, la cual se
                        reparte de forma equitativa. Este modelo tiene en cuenta el crecimiento de cada consumidor,
                        incentivando una participación activa y consciente en el cuidado de la salud de todos. <br><br>

                        Así, elige productos naturales no solo transforma tu vida, sino que contribuye a crear un
                        círculo virtuoso de apoyo y crecimiento. Cada paso que das hacia tu propio bienestar también
                        impulsa a otros en ese mismo camino, fomentando una red de solidaridad donde el bienestar
                        colectivo es tan importante como el individual. En este ecosistema, cuidar de nuestra salud se
                        convierte en una oportunidad para construir juntos un futuro más saludable y solidario.
                    </p>
                </div>
            </div>
            <div class=" flex items-center col-span-5 md:col-span-2">
                <img class=" rounded-md shadow-md"
                    src="https://miamidiario.com/wp-content/uploads/F35ICS6ZOZFKPAAKPGG6XUN5XM.jpg"
                    class=" object-cover" alt="">
            </div>

        </div>

        <div class=" grid grid-cols-4 gap-6 md:gap-x-10 lg:gap-3 xl:gap-4 mt-8 md:mt-12">

            <p class=" col-span-4 text-2xl font-bold text-palette-200 text-center md:mb-4">Diferentes servicios. </p>
            <div class=" col-span-4 md:col-span-2 lg:col-span-1 bg-palette-200 rounded-md shadow-md">
                <img class=" rounded-t-md"
                    src="https://cdn.pixabay.com/photo/2020/08/05/20/47/fruits-5466407_1280.jpg"
                    alt="" >
                <div class="py-6 px-4">
                    <p class=" text-center text-palette-100 font-bold text-lg">
                        Cuida tu Salud de Forma Natural
                    </p>
                    <p class=" text-center text-palette-100 mt-4">
                        Optar por productos naturales ayuda a mantener un equilibrio saludable, respetando el bienestar del cuerpo y del entorno.</p>
                    </p>
                </div>
            </div>

            <div class=" col-span-4 md:col-span-2 lg:col-span-1 bg-palette-300 rounded-md shadow-md">
                <img class=" rounded-t-md"
                    src="https://media.istockphoto.com/id/1325214348/es/foto/d%C3%ADa-mundial-del-medio-ambiente-con-el-trabajo-en-equipo-de-la-comunidad-global-grupo-de.jpg?s=1024x1024&w=is&k=20&c=rw2pnJWQK_wdS29xA01OeBohhx2sbAsdY13Q3wJs658="
                    alt="">
                <div class="py-6 px-4">
                    <p class=" text-center text-palette-100 font-bold text-lg">
                        Un Ecosistema Solidario
                    </p>
                    <p class=" text-center text-palette-100 mt-4">
                        Cada compra contribuye a una bolsa global, donde los beneficios se distribuyen para fomentar el bienestar colectivo.
                    </p>
                </div>
            </div>

            <div class="col-span-4 md:col-span-2 lg:col-span-1 bg-palette-400 rounded-md shadow-md">
                <img class=" rounded-t-md"
                    src="https://media.istockphoto.com/id/1484825666/es/foto/el-seguimiento-y-el-an%C3%A1lisis-de-los-datos-de-la-competencia-impulsan-el-crecimiento-del.jpg?s=1024x1024&w=is&k=20&c=jN4A3j0zFcI1MwYkdjuca87ofivUd5rEngajq492yK0="
                    alt="">
                <div class="py-6 px-4">
                    <p class=" text-center text-palette-100 font-bold text-lg">
                        Crecimiento Compartido
                    </p>
                    <p class=" text-center text-palette-100 mt-4">
                        El crecimiento de cada consumidor refuerza a toda la comunidad, creando un círculo virtuoso de apoyo y solidaridad.
                    </p>
                </div>
            </div>
            <div class="col-span-4 md:col-span-2 lg:col-span-1 bg-palette-500 rounded-md shadow-md">
                <img class=" rounded-t-md"
                    src="https://cdn.pixabay.com/photo/2023/11/18/16/09/pears-8396722_1280.jpg"
                    alt="">
                <div class="py-6 px-4">
                    <p class=" text-center text-palette-100  font-bold text-lg">
                        Construyendo un Futuro Saludable
                    </p>
                    <p class=" text-center text-palette-100 ">

                        Elige un estilo de vida saludable que no solo transforme tu bienestar, sino también el de quienes te rodean.
                    </p>
                </div>
            </div>

        </div>

    </div>

</x-app-layout>
