DROP TRIGGER tg1;
CREATE TRIGGER tg1 AFTER INSERT ON t_casehandle
FOR EACH ROW
  BEGIN
    IF (new.state = '申诉') then
      UPDATE t_case SET state = '申诉'  WHERE id = new.case_id;
    END IF;
  END;