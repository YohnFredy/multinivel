<div>

    Acepto los
    <x-link wire:clicK="service">
        Términos de servicio
    </x-link>
    y la
    <x-link wire:clicK="policy">
        Política de privacidad
    </x-link>


    <x-dialog-modal wire:model="terms">
        <x-slot name="title">
            <h2 class="text-2xl font-semibold text-blue-500">
                Términos de Servicio
            </h2>
        </x-slot>

        <x-slot name="content">
            <h5 class="font-semibold">1. Aceptación de los términos</h5>
            <h6 class="mb-2">Al acceder y utilizar el sitio web de Fornuvi, aceptas estar sujeto a estos Términos de
                Servicio. Si no estás de acuerdo con alguno de los términos, te recomendamos no registrarte ni utilizar
                nuestros servicios.</h6>

            <h5 class="font-semibold">2. Descripción del servicio</h5>
            <h6 class="mb-2">Fornuvi es una tienda online que ofrece una variedad de productos naturales. También
                ofrecemos un programa de fidelidad y afiliados en el cual los clientes pueden recibir incentivos por
                recomendar nuestros productos a otras personas. Al registrarte en nuestra página, aceptas cumplir con
                estos términos y condiciones.</h6>

            <h5 class="font-semibold">3. Registro y cuenta</h5>
            <h6 class="mb-2">Para realizar compras o participar en el programa de afiliados, debes crear una cuenta en
                nuestro sitio. Eres responsable de mantener la confidencialidad de la información de tu cuenta, así como
                de todas las actividades que se realicen bajo tu cuenta.</h6>

            <h5 class="font-semibold">4. Programa de afiliados y fidelidad</h5>
            <h6 class="mb-2">Nuestros clientes pueden ganar incentivos al recomendar nuestros productos a otras
                personas. Las comisiones o incentivos se basan en el crecimiento y las compras realizadas por los
                referidos directos. Nos reservamos el derecho de modificar las tasas de comisión y las reglas del
                programa en cualquier momento sin previo aviso. Cualquier actividad fraudulenta puede resultar en la
                terminación de la cuenta de afiliado y la pérdida de los incentivos acumulados.</h6>

            <h5 class="font-semibold">5. Pagos y comisiones</h5>
            <h6 class="mb-2">Los incentivos por recomendaciones se calculan según las ventas generadas por los
                referidos. Los pagos se realizarán una vez alcanzado el umbral mínimo, y los métodos de pago serán
                acordados previamente. Fornuvi se reserva el derecho de ajustar los montos y plazos de pago según lo
                considere necesario.</h6>

            <h5 class="font-semibold">6. Propiedad intelectual</h5>
            <h6 class="mb-2">Todos los contenidos, marcas registradas, logos y gráficos utilizados en nuestro sitio
                web son propiedad de Fornuvi y están protegidos por las leyes de propiedad intelectual. No se permite el
                uso no autorizado de estos materiales.</h6>

            <h5 class="font-semibold">7. Modificaciones al servicio</h5>
            <h6 class="mb-2">Nos reservamos el derecho de modificar, suspender o descontinuar cualquier parte de
                nuestros servicios en cualquier momento sin previo aviso. Esto incluye cambios en los productos, precios
                o en las condiciones del programa de afiliados.</h6>

            <h5 class="font-semibold">8. Limitación de responsabilidad</h5>
            <h6 class="mb-2">Fornuvi no será responsable por ningún daño directo, indirecto, incidental o consecuente
                derivado del uso o la imposibilidad de uso de los servicios, incluyendo pérdidas de ingresos o
                comisiones.</h6>

            <h5 class="font-semibold">9. Terminación</h5>
            <h6 class="mb-2">Nos reservamos el derecho de suspender o cancelar cualquier cuenta en caso de violación
                de estos Términos de Servicio o por comportamiento fraudulento.</h6>

            <h5 class="font-semibold">10. Ley aplicable</h5>
            <h6 class="mb-2">Estos Términos de Servicio se regirán e interpretarán de acuerdo con las leyes de
                Colombia, sin que surjan conflictos con otras disposiciones legales.</h6>
        </x-slot>

        <x-slot name="footer">
            <x-button type="button" wire:click="$set('terms', false)">
                Cerrar
            </x-button>
        </x-slot>
    </x-dialog-modal>

    <x-dialog-modal wire:model="privacy">
        <x-slot name="title">
            <h2 class="text-2xl font-semibold text-blue-500">
                Política de Privacidad
            </h2>
        </x-slot>

        <x-slot name="content">
            <h5 class="font-semibold">1. Introducción</h5>
            <h6 class="mb-2">En Fornuvi, nos comprometemos a proteger tu privacidad. Esta política explica cómo
                recopilamos, utilizamos y protegemos la información personal que compartes al usar nuestra tienda online
                y participar en nuestro programa de afiliados.</h6>

            <h5 class="font-semibold">2. Información que recopilamos</h5>
            <h6 class="mb-2">Recopilamos información personal cuando te registras en nuestro sitio web, realizas una
                compra o participas en nuestro programa de fidelidad. Esto puede incluir tu nombre, dirección de correo
                electrónico, dirección postal, información de pago y datos relacionados con las actividades de tus
                referidos.</h6>

            <h5 class="font-semibold">3. Uso de la información</h5>
            <h6 class="mb-2">Utilizamos la información personal para:
                <ul>
                    <li> • Procesar tus pedidos y enviarte los productos comprados.</li>
                    <li> • Administrar tu participación en el programa de fidelidad y afiliados.</li>
                    <li> • Enviarte actualizaciones sobre productos, promociones, y noticias (con tu consentimiento
                        previo).</li>
                    <li> • Mejorar nuestro sitio web y ofrecerte una experiencia personalizada.</li>
                </ul>

            </h6>

            <h5 class="font-semibold">4. Compartir información con terceros</h5>
            <h6 class="mb-2">No compartimos, vendemos ni alquilamos tu información personal a terceros sin tu
                consentimiento, salvo cuando sea necesario para cumplir con obligaciones legales o procesar
                transacciones financieras (como el procesamiento de pagos).</h6>

            <h5 class="font-semibold">5. Cookies y tecnologías de seguimiento</h5>
            <h6 class="mb-2">Usamos cookies y tecnologías de seguimiento para mejorar tu experiencia en nuestro sitio
                web, ofrecerte contenido personalizado y realizar análisis sobre el tráfico en la web. Puedes
                deshabilitar las cookies en la configuración de tu navegador, pero algunas funciones del sitio podrían
                verse afectadas.</h6>

            <h5 class="font-semibold">6. Seguridad de los datos</h5>
            <h6 class="mb-2">Implementamos medidas de seguridad apropiadas para proteger la información personal de
                acceso no autorizado, alteración, divulgación o destrucción. Sin embargo, no podemos garantizar la
                seguridad absoluta de los datos transmitidos por internet.</h6>

            <h5 class="font-semibold">7. Retención de la información</h5>
            <h6 class="mb-2">Conservamos tu información personal mientras sea necesario para proporcionarte nuestros
                servicios, cumplir con obligaciones legales o resolver disputas. Si deseas eliminar tu cuenta o datos,
                puedes contactarnos en cualquier momento.</h6>

            <h5 class="font-semibold">8. Tus derechos</h5>
            <h6 class="mb-2">Tienes derecho a acceder, corregir o eliminar la información personal que tenemos sobre
                ti. Para ejercer estos derechos, ponte en contacto con nosotros a través de contacto@fornuvi.com.</h6>

            <h5 class="font-semibold">9. Cambios en la política de privacidad</h5>
            <h6 class="mb-2">Nos reservamos el derecho de modificar esta Política de Privacidad en cualquier momento.
                Los cambios entrarán en vigor desde el momento en que se publiquen en nuestro sitio web.</h6>

            <h5 class="font-semibold">10. Contacto</h5>
            <h6 class="mb-2">Si tienes alguna pregunta o inquietud sobre nuestra Política de Privacidad o el uso de tu
                información personal, contáctanos a través de contacto@fornuvi.com.</h6>
        </x-slot>

        <x-slot name="footer">
            <x-button type="button" wire:click="$set('privacy', false)">
                Cerrar
            </x-button>
        </x-slot>
    </x-dialog-modal>

</div>
