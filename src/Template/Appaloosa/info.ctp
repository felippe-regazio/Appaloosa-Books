<section class="info">
    <div id="publish" class="info-hero">
        <div class="info-hero__content">
            <div class="side a clipfollow" data-bg="dorothea-lange.jpg">
                <!-- a side -->
                <h1>INFORMAÇÕES ÚTEIS</h1>
            </div>
            <div class="side b">
                <!-- b side -->
                <h1>INFORMAÇÕES ÚTEIS</h1>
            </div>
        </div>
    </div>
<!-- QUEM SOMOS  -->
        <div class="about">
            <div class="about__content">
                <div class="about__content-header">
                    <span class="about-toggle">
                        <h1><i class="fa fa-arrow-right"></i> Quero publicar através da Appaloosa</h1>
                        <br/>
                    </span>
                </div>
                <div class="about__content-body read-more">
                    <p>
                        Para submissão de originais, utilize o e-mail <?= AP_ORIGINALS_EMAIL ?>. Temos predileção pelos gêneros Poesia, Conto, Crônica e Romance. Havendo interesse, ou não, entraremos em contato. A Appaloosa não emite parecer tecnico à respeito dos textos submetidos para análise, nos reservamos apenas a selecionar o material de interesse para possível publicação. Observadas as condições e aprovados os contratos, todo o processo de edição e disponibilização do livro digital será executado de forma gratuita, cabendo ao autor apenas o compromisso de divulgação do seu trabalho. Somos pouquíssimas pessoas tocando esse imenso barco, então esse processo pode demorar um pouquinho, mas sempre retornamos o contato.
                    </p>
                </div>
                <div class="about__content-footer">
                    
                </div>
            </div>
        </div>
<!-- QUEM SOMOS  -->
        <div id="digital" class="about">
            <div class="about__content">
                <div class="about__content-header">
                    <span class="about-toggle">
                        <h1><i class="fa fa-arrow-right"></i> O que são Livros Digitais?</h1>
                    </span>
                </div>
                <div class="about__content-body read-more">
                    <p>
                        Livros digitais são uma alternativa ascendente no mercado editorial. Um livro digital pode ser lido em um computador ou dispositivo de leitura (e-Reader), celulares e computadores. A Appaloosa trabalha com os formatos EPUB e PDF disponibilizados gratuitamente para download, respeitando o direito e propriedade do autor sobre.
                    </p>
                </div>
                <div class="about__content-footer">
                    
                </div>
            </div>
        </div>
<!-- PARCERIA COLAB DOACAO  -->
        <div id="friends" class="about">
            <div class="about__content">
                <div class="about__content-header">
                    <span class="about-toggle">
                        <h1><i class="fa fa-arrow-right"></i> Parceria, Colaboração e Doação</h1>
                    </span>
                </div>
                <div class="about__content-body read-more">
                    <p>
                        Estamos abertos a receber novos parceiros e colaboradores. Se você acredita que podemos desenvolver uma relação saudável de protocooperação, por favor, envie-nos um e-mail com sua proposta para <?= AP_CONTACT_EMAIL ?>. Trabalhamos com diferentes formatos de parcerias tendo como princípio um dos nossos valores sempre presente: a difusão da literatura mundial por meio digital.
                    </p>
                </div>
                <div class="about__content-footer">
                    <a class="ap-btn ap-btn--primary" href=""><i class="fa fa-heart"></i> Doar</a> 
                    <p class="btc">BTC: 17mwnEWhckrWSVbJNPHTFstcVbYYyMJhPx</p>                   
                </div>
            </div>
        </div>        
<!-- BLACK LINE -->
    <div id = "team"
         class="ap-line"
         data-aos="line-reveal" 
         data-aos-offset="150" 
         data-aos-once="true">      
    </div>
<!-- FOUNDER -->
    <div class="founder">
        <div class="founder__content">
            <div class="founder__content-title">
                <span class="about-toggle">
                    <h1><i class="fa fa-coffee"></i> O Criadore e a criatura</h1>
                </span>            
            </div>
            <div class="founder__content-img">
                <?= $this->Html->Image("founder.jpg", ["alt"=>"Imagem do fundador da Appaloosa Books"]); ?>
            </div>
            <div class="founder__content-about">
                <h2>Felippe Regazio</h2>
                <span>Programador e Fundador</span>
                <br/>
                <p>
                    Desenvolvedor web, apaixonado por literatura, skatista das antigas, mochileiro aposentado e um incurável longlife learner. Felippe tem sido desenvolvedor uno da Appaloosa no que tange sua concepção, design, e programação (webpage e algoritmos para melhor desempenho). Dentro da Appaloosa Felippe atua majoritariamente no desenvolvimento e aperfeiçoamento da plataforma digital, e também como editor, promovendo antologias e descobrindo novos autores. Embora tenha publicado alguns livros, declara-se um escritor aposentado do mundo das publicações, e atualmente escreve e finge que esqueceu. Felippe tem <?= date("Y") - 1991 ?> anos e mora em Caçapava - SP.
                </p>
            </div>
        </div>
    </div>
    <!-- PARCEIROS -->
    <?php 

        $partners = [        
            0 => [
                "name" => "Bruno Ribeiro",
                "image" => "brunoribeiro.jpg",
                "task" => "Escritor, editor e reviewer",
                "about" => "Bruno Ribeiro, nasceu em julho de 1989, é mineiro radicado na Paraíba, com tiques argentinos. Graduado em publicidade & propaganda e mestre em Escrita Criativa pela Universidad Nacional de Tres de Febrero, de Buenos Aires, Bruno escreve, traduz, roteiriza, bagunça e experimenta. Publicou em jornais, revistas, blogues, livros e antologias mundo afora.",
                "link" => "",
            ],
            1 => [
                "name" => "Ítalo Lima",
                "image" => "italolima.jpg",
                "task" => "Escritor e conteudista",
                "about" => "Ítalo Lima nasceu em Teresina/PI. Formado em Publicidade e Propaganda e cheio de inquietações na pele. Poeta em estado constante de aflição. Em 2014 criou o projeto no Instagram (@italolimapoesias) onde vende poesia em moldura e até hoje vem curando a solidão através de quadros poéticos. Da solidão ao erotismo, Itálo escreveu 'Quando a gente se mata numa poesia', lançado em 2017, na Bienal do livro, no Rio de Janeiro.",
                "link" => "",
            ],

        ];
    ?>    
        
    <?php foreach($partners as $key => $partner): ?>    
        <div class="founder">
            <div class="founder__content">
                <?php 
                    // printa o titulo apenas na primeira iteracao
                    reset($partners);
                    if ( $key === key($partners) ):
                ?>
                    <div class="founder__content-title">
                        <span class="about-toggle">
                            <h1><i class="fa fa-handshake"></i> Parceiros e colaboradores</h1>
                        </span>            
                    </div>
                <?php endif; ?>
                <div class="founder__content-img">
                    <?= $this->Html->Image("colab/" . $partner["image"], ["alt"=>"Imagem do Colaborador da Appaloosa, " . $partner["name"]] ); ?>
                </div>
                <div class="founder__content-about">
                    <h2><?= $partner["name"] ?></h2>
                    <span><?= $partner["task"] ?></span>
                    <p>
                        <?= $partner["about"] ?>
                    </p>
                </div>
            </div>
        </div>    
    <?php endforeach; ?>
</section>