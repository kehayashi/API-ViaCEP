<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <title>Teste 3</title>
        <link href="css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <header>
            <div class="center">
                <h3>Consultar CEP's</h3>
            </div>
        </header>
        <main>
            <div class="container">
                <form action="/api" method="post">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div id="div-inputs">
                        <div class="cep-input">
                            <label>CEP:</label>
                            <input type="text" placeholder="Digite o cep que deseja buscar" name="cepcode[]" required>
                        </div>
                    </div>
                    <div>
                        <button class="info" type="button" onclick="addInput()">Adicionar + 1 CEP</button>
                        <button class="success" type="submit">Buscar</button>
                    </div>
                </form>
            </div>
            <div class="container">
                <div class="content" id="content">
                    <div>
                        @if (!empty($array_ceps)) 
                        <!-- table -->
                        <table>
                            <thead>
                                <tr>
                                    <th>CEP</th>
                                    <th>Logradouro</th>
                                    <th>Complemento</th>
                                    <th>Bairo</th>
                                    <th>Localidade</th>
                                    <th>UF</th>
                                    <th>IBGE</th>
                                    <th>GIA</th>
                                    <th>DDD</th>
                                    <th>Siafi</th>
                                </tr>
                            </thead>
                            @foreach ($array_ceps as $cep)
                                <tbody>
                                    <tr>
                                        <td>{{ $cep->cep }}</td>
                                        <td>{{ $cep->logradouro }}</td>
                                        <td>{{ $cep->complemento }}</td>
                                        <td>{{ $cep->bairro }}</td>
                                        <td>{{ $cep->localidade }}</td> 
                                        <td>{{ $cep->uf }}</td> 
                                        <td>{{ $cep->ibge }}</td> 
                                        <td>{{ $cep->gia }}</td> 
                                        <td>{{ $cep->ddd }}</td> 
                                        <td>{{ $cep->siafi }}</td> 
                                    </tr>
                                </tbody>
                            @endforeach
                        </table>
                        <!-- end table -->
                    </div>
                    <div class="div-buttons" >
                        <div style="display: inline">
                            <a role="button" data-js="export-table-btn" class="info">
                                Exportar para CSV
                            </a>
                        <button type="button" class="danger" onclick="removeTable()">Excluir tabela</button>
                        </div>
                    </div>
                </div>

                @elseif (isset($array_ceps) && empty($array_ceps))
                <span>Nenhum cep encontrado!</span>
                @endif
            </div>
        </main>
    </body>
</html>

<script>

    function addInput() {
        var div = document.getElementById('div-inputs').insertAdjacentHTML('beforeend', '<div class="cep-input"><label>CEP:</label><input type="text" placeholder="Digite o cep que deseja buscar" name="cepcode[]" required/></div>')
    }

    const exportBtn = document.querySelector('[data-js="export-table-btn"]')
    const tableRows = document.querySelectorAll('tr');

    exportBtn = addEventListener('click', ()=> {
        const CSVContent = Array.from(tableRows)
            .map(row => Array.from(row.cells)
            .map(cell => cell.textContent)
            .join(',')
        )
        .join('\n')

        exportBtn.setAttribute(
            'href',
            `data:text/csvcharset=utf-8, ${encodeURIComponent(CSVContent)}`
        )

        exportBtn.setAttribute('download', 'tableCeps.csv')
    })

    function removeTable() {
        document.getElementById('content').remove()

    }
</script>
