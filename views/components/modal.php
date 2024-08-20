<div class="modal fade"
     id="melhoria_<?= $melhoria->id ?>"
     tabindex="-1" role="dialog"
     aria-labelledby="melhoria_<?php echo $melhoria->tarefa ?>"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <form id="form_<?php echo $melhoria->id ?>">
                    <div class="mb-3">
                        <label for="tarefa" class="form-label">Tarefa</label>
                        <textarea style="resize: none" class="form-control mb-4" rows="4" id="tarefa" readonly
                                  draggable="false"><?= $melhoria->tarefa; ?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="descricao" class="form-label">Descrição</label>
                        <textarea style="resize: none" class="form-control mb-4" rows="4" id="descricao"
                                  draggable="false"
                                  readonly><?= $melhoria->descricao; ?></textarea>
                    </div>
                    <div class="form-group form-row">
                        <div class="col">
                            <label for="prazo_legal">Prazo legal</label>
                            <input type="date"
                                   class="form-control mb-2"
                                   id="prazo_legal"
                                   placeholder="Prazo legal"
                                   readonly
                                   value="<?= $melhoria->prazo_legal !== null ? $melhoria->prazo_legal->format('Y-m-d') : null; ?>">
                        </div>
                        <div class="col">
                            <label for="prazo_acordado">Prazo acordado</label>
                            <input type="text"
                                   class="form-control"
                                   id="prazo_acordado"
                                   placeholder="Prazo acordado"
                                   readonly
                                   value="<?= $melhoria->prazo_acordado !== null ? $melhoria->prazo_acordado->format('Y-m-d') : null; ?>">
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col">
                            <label for="gravidade">Gravidade</label>
                            <select class="form-control"
                                    id="gravidade">
                                <option value='0'>Não informado
                                </option>
                                <?php foreach ($gravidadesAll as $gravidade) : ?>
                                    <option <?php echo $gravidade->id == $melhoria->gravidade ? 'selected' : '' ?>
                                            value="<?php echo $gravidade->id ?>"><?php echo $gravidade->descricao ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="urgencia">Urgência</label>
                            <select class="form-control"
                                    id="urgencia">
                                <option value='0'>Não informado
                                </option>
                                <?php foreach ($urgenciasAll as $urgencia) : ?>
                                    <option <?php echo $urgencia->id == $melhoria->urgencia ? 'selected' : '' ?>
                                            value="<?php echo $urgencia->id ?>"><?php echo $urgencia->descricao ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group form-row">
                        <div class="col">
                            <label for="tendencia">Tendência</label>
                            <select class="form-control"
                                    id="tendencia">
                                <option value='0'>Não informado
                                </option>
                                <?php foreach ($tendenciasAll as $tendencia) : ?>
                                    <option <?php echo $tendencia->id == $melhoria->tendencia ? 'selected' : '' ?>
                                            value="<?php echo $tendencia->id ?>"><?php echo $tendencia->descricao ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col">
                            <div class="form-check mb-2">
                                <input class="form-check-input"
                                       type="checkbox"
                                       id="demanda_legal"
                                       readonly <?php echo (bool)$melhoria->demanda_legal ? 'checked' : '' ?>>
                                <label class="form-check-label"
                                       for="demanda_legal">Demanda
                                    Legal</label>
                            </div>
                        </div>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary">Editar</button>
                <button type="button" class="btn btn-danger melhoria-delete-button" data-melhoria="<?= $melhoria->id; ?>">Deletar</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>